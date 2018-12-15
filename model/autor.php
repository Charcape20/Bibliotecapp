<?php 

//Modelo de Autor
class Autor 
{
	//Atributos que representan sus campos
	private $pdo;
	public $Nombres; 
    public $ApellidoPaterno;
	public $ApellidoMaterno;
	public $sexo_id;
	public $estado_id;
	public $FechaNacimiento;
	public $PaisNacimiento;
	public $Celular;
	public $Email;
	public $id;


	//Constructor que permite la conexion a la BD
	public function __construct()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}

	}

	//Funcion que obtiene todos los registros de los autores
	public function Listar()
	{
		try
		{
	
			$stm = $this->pdo->prepare("SELECT * FROM autores");
			$stm->execute();

			//FetchAll retorna todos las filas como objetos, DE GOLPE
			//En cambio, el fetch los retorna de uno por uno
			//Es recomendable el fetch cuando se esperan muchos datos
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	//Funcion donde se obteniene a los autores de acuerdo a un respectivo correo
	public function Obtener2($email)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM autores WHERE Email = ?");

			$stm->execute(array($email));
			
			return $stm->fetch(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM autores WHERE id = ?");

			$stm->execute(array($id));
			
			return $stm->fetch(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


	//Funcion donde se eliminan a los autores de acuerdo a un respectivo id
	public function Eliminar($id)
	{
		try 
		{
			$sql = "UPDATE autores SET  estado_id = ? WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(array(2,$id));

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


	//Funcion que actualiza los datos
	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE autores SET 
						Nombres          = ?, 
						ApellidoPaterno        = ?,
                        ApellidoMaterno        = ?,
                        sexo_id        = ?,
						estado_id = ?,
						FechaNacimiento = ?,
						PaisNacimiento = ?,
						Celular = ?,
						Email = ?
				    WHERE id = ?";

			
			//se prepara la sentencia para que se guarde lo que contiene el array asociativo data
			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->Nombres, 
                        $data->ApellidoPaterno,
                        $data->ApellidoMaterno,
                        $data->sexo_id,
                        $data->estado_id,
                        $data->FechaNacimiento,
                        $data->PaisNacimiento,
                        $data->Celular,
                        $data->Email,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


	//Funcion donde se registra
	public function Registrar(Autor $data)
	{
		try 
		{
		$sql = "INSERT INTO autores (Nombres, ApellidoPaterno,ApellidoMaterno,sexo_id,estado_id,FechaNacimiento,PaisNacimiento,Celular,Email) 
		        VALUES (?, ? , ? , ? , ? , ? , ? , ? , ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->Nombres, 
                        $data->ApellidoPaterno,
                        $data->ApellidoMaterno,
                        $data->sexo_id,
                        $data->estado_id,
                        $data->FechaNacimiento,
                        $data->PaisNacimiento,
                        $data->Celular,
                        $data->Email
                )
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}
