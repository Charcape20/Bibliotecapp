<?php

require_once 'model/autor.php';

require_once 'model/sexo.php';

require_once 'model/estado.php';

class AutorController{
    
    private $model;
    private $model_autor;
    private $model_estado;

    public function __CONSTRUCT(){

        //Se instancian los siguientes modelos
        $this->model = new Autor();
        $this->model_autor = new Sexo();
        $this->model_estado = new Estado();
    
    }
    
    public function Index(){

        require_once 'view/inicio/inicio.php';
        require_once 'view/autor/autor.php';
        require_once 'view/footer.php';
    }
    
    //Esta funcion sirve para editar
    public function Crud(){
        
        $alm = new Autor();
        
        $sexos = new Sexo();
        $estados = new Estado();


        //Si el id existe y no es un valor nulo entonces se obtiene los datos 
        if(isset($_REQUEST['id'])){
            $alm = $this->model->Obtener($_REQUEST['id']);
        }

        //Se listan los datos de los demas modelos
        $sexos = $this->model_autor->Listar();
        
        $estados =   $this->model_estado->Listar();
        
        //Y se muestra la ventana de Editar Autor
        require_once 'view/inicio/inicio.php';
        require_once 'view/autor/autor-editar.php';
        require_once 'view/footer.php';
    
    }
    
    //Funcion para guardar autores
    public function Guardar(){

        //Se Instancian de la clase Autor, y se almacenan los datos que se obtienen desdee el  autor-editar.php
        $alm = new Autor();
        
        $alm->id = $_REQUEST['id'];
        $alm->Nombres = $_REQUEST['Nombres']; 
        $alm->ApellidoPaterno = $_REQUEST['ApellidoPaterno'];
        $alm->ApellidoMaterno = $_REQUEST['ApellidoMaterno'];
        $alm->sexo_id = $_REQUEST['sexo_id'];
        $alm->estado_id = $_REQUEST['estado_id'];
        $alm->FechaNacimiento = $_REQUEST['FechaNacimiento'];
        $alm->PaisNacimiento = $_REQUEST['PaisNacimiento'];
        $alm->Celular = $_REQUEST['Celular'];
        $alm->Email = $_REQUEST['Email'];



        //si el ID > 0, se actualizan los datos, si no solo se registran
        $alm->id > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);

        //Luego se regresa al Index
        header('Location: /?c=Autor&a=Index');
        
    }
    
    public function Eliminar(){
        
        $this->model->Eliminar($_REQUEST['id']);

        header('Location: /?c=Autor&a=Index');
    }
}