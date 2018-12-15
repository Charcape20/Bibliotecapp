<?php

	require_once 'model/estado.php';
	require_once 'model/genero.php';
	require_once 'model/editorial.php';
	require_once 'model/autor.php';
	require_once 'model/libro.php';
	require_once 'model/libro_autor.php';

class LibroController
{
	private $model;
	private $model_estado;
	private $model_genero;
	private $model_editorial;
	private $model_autor;
	private $model_libro_autor;


	public function __CONSTRUCT(){

		$this->model = new Libro();
		$this->model_estado = new Estado();
		$this->model_genero =  new Genero();
		$this->model_editorial =  new Editorial();
		$this->model_autor =  new Autor();
		$this->model_libro_autor = new LibroAutor();    
    }

    public function Index()
    {

    	require_once 'view/inicio/inicio.php';
    	require_once 'view/libro/index.php';
    	require_once 'view/footer.php';

    }

    public function BusquedaBootGrid()
    {

    	echo $this->model->BusquedaBootGrid();
    }


	public function RegistrarLibro()
	{

		$estados =  $this->model_estado->Listar();
		$generos =  $this->model_genero->Listar();
		$editoriales = $this->model_editorial->Listar();
		$autores = $this->model_autor->Listar();

		require_once 'view/inicio/inicio.php';
		require_once 'view/libro/registrarlibro.php';
		require_once 'view/footer.php';

	}


	public function EditarLibro()
	{
		$libro = new Libro();
		$estados = new Estado();
		$editoriales = new Editorial();
		$generos = new Genero();

		if(isset($_REQUEST['id'])){
            $libro = $this->model->Obtener($_REQUEST['id']);
        }

        
		$estados =   $this->model_estado->Listar();
		$editoriales = $this->model_editorial->Listar();
		$generos = $this->model_genero->Listar();
		
        require_once 'view/inicio/inicio.php';
        require_once 'view/libro/libro-editar.php';
        require_once 'view/footer.php';
	}
	public function GuardarLibro()
	{
		
		$codigo_libro_insertado  = 0;

		try {
			
					// Imagen Libro por Defecto.

				$libro = new Libro();

				$libro->nombre_libro = $_REQUEST['nombre_libro'];
				$libro->editorial_id = $_REQUEST['editorial_id'];
				$libro->estado_id = $_REQUEST['estado_id'];
				$libro->genero_id = $_REQUEST['genero_id'];
				$libro->numero_paginas = $_REQUEST['numero_paginas'];
				$libro->anio_edicion = $_REQUEST['anio_edicion'];
				$libro->FechaPublicacion = $_REQUEST['FechaPublicacion'];
				$libro->codigo_isbn = $_REQUEST['codigo_isbn'];
				$libro->resumen = $_REQUEST['resumen'];
				$libro->RutaImagenReferencia = '../assets/img/default.png';

				if ($_FILES['RutaImagenReferencia']['name'] == '') {
					
					$libro->bimagenReferencia = 0;
				
				} else {

					$libro->bimagenReferencia = 1;
				}
				

				$codigo_libro_insertado = $this->model->Registrar($libro); 		

	
				if ( $codigo_libro_insertado > 0) {
					
					foreach ($_REQUEST['autores_id'] as $fila) {

						$autor_libro = new LibroAutor();

						$autor_libro->libro_id = $codigo_libro_insertado;
						$autor_libro->autor_id = $fila[0];
						$this->model_libro_autor->Registrar($autor_libro);
						$autor_libro = null;				

					}

					if ( $libro->bimagenReferencia == 1 ) {

						$nombre_archivo = basename($_FILES['RutaImagenReferencia']['name']);

			            $res = explode(".", $nombre_archivo);
			            
			            $extension = $res[count($res)-1];
			            
			            $nombre = date("YmdHis")."." . $extension;

			            $dirtemp = "assets/img/libro/".$nombre.""; 
			            

						if (move_uploaded_file($_FILES['RutaImagenReferencia']['tmp_name'], $dirtemp)) {

						    $this->model->Actualizar_RutaImagenReferencia( "../" . $dirtemp , $codigo_libro_insertado);

						} else {
						    
						    echo "Error a la cargar la imagen para el libro.";

						}

					}

					header('Location: /?c=Inicio&a=Index');


				} else {
					
					echo "Error al Guardar el Libro.";
				}
				
		} catch (Exception $e) {
			
			die($e->getMessage());
		}

	}

}