<?php
require_once 'profesor.php';
require_once 'alumno.php';
require_once 'autor.php';

class User {

	private $pdo;
	public $pdo_aux;
	private $profesor;
	private $password;
	private $emailid;
	private $users_tipos_id;
	private $user_img;
	private $email;

	public function __construct()
	{
		try
		{
			$this->pdo = Database::StartUp();     
			$this->pdo_aux = Database::StartUp();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		} 

	}


	
	public function Devuelve_Datos_Sesion_Usuario($email,$password)
	{
		try 
			{


				$stm = $this->pdo
				          ->prepare("SELECT * FROM users 
				          			 WHERE emailid = ? and password= ?");
				          

				$stm->execute(array($email,$password));
				
				$tipo_usuario = 0;
				$id_usuario = 0;
				$user_img = '';
				$email = '';
				
				$arr  = array('nRetorno' => -1, 'cMensajeRetorno' =>'',
							  'Nombres' => '',
							  'ApellidoPaterno' => '',
							  'ApellidoMaterno' => '',
							  'sexo_id' => 0,
							  'estado_id' => 0,
							  'FechaNacimiento' => '',
							  'Celular' => '',
							  'dni' => '',
							  'user_id' => 0,
							  'emailid' => '',
							  'user_img' => '',
							  'tipo_usuario' => '');
				
				
				$registros = $stm->fetch(PDO::FETCH_ASSOC);
				


				if ( $registros ) {
					
					$tipo_usuario = $registros['users_tipos_id'];
					$user_img = $registros['RutaUserReferencia'];
					$id_usuario = $registros['id'];
					$email = $registros['emailid'];
				
					switch ($tipo_usuario) {
						case 1: // Profesor
							
							$profesor = new Profesor();

							$data = $profesor->Obtener_x_UserID($id_usuario);
								
							$arr["Nombres"] = $data->Nombres;
							$arr["ApellidoPaterno"] = $data->ApellidoPaterno;
							$arr["ApellidoMaterno"] = $data->ApellidoMaterno;
							$arr["sexo_id"] = $data->sexo_id;
							$arr["estado_id"] = $data->estado_id;
							$arr["FechaNacimiento"] = $data->FechaNacimiento;
							$arr["Celular"] = $data->Celular;
							$arr["dni"] = $data->dni;
							$arr["user_id"] = $data->user_id;
							$arr["email"] = $email;
							$arr["user_img"] = $user_img;
							$arr["tipo_usuario"] = $tipo_usuario;
							$profesor = null;
							$data = null;


							# code...
							break;
						
						case 2: // Alumnos

							$alumno = new Alumno();
							
							$data = $alumno->Obtener_x_UserID($id_usuario);

							$arr["Nombres"] = $data->Nombres;
							$arr["ApellidoPaterno"] = $data->ApellidoPaterno;
							$arr["ApellidoMaterno"] =  $data->ApellidoMaterno;
							$arr["sexo_id"] =$data->sexo_id;
							$arr["estado_id"] =  $data->estado_id;
							$arr["FechaNacimiento"] =  $data->FechaNacimiento;
							$arr["Celular"] = $data->Celular;
							$arr["dni"] = $data->dni;
							$arr["user_id"] = $data->user_id;
							$arr["email"] = $email;
							$arr["user_img"] = $user_img;
							$arr["tipo_usuario"] = $tipo_usuario;
							
							$alumno = null;
							$data = null;
							break;

						case 3:	 // Administradores
							$autor = new Autor();
							$data = $autor->Obtener2($email);
							$arr["Nombres"] = $data->Nombres;
							$arr["ApellidoPaterno"] = $data->ApellidoPaterno;
							$arr["ApellidoMaterno"] =  $data->ApellidoMaterno;
							$arr["sexo_id"] =$data->sexo_id;
							$arr["estado_id"] =  $data->estado_id;
							$arr["FechaNacimiento"] =  $data->FechaNacimiento;
							$arr["Celular"] = $data->Celular;
							$arr["email"] = $email;
							$arr["user_img"] = $user_img;
							$arr["tipo_usuario"] = $tipo_usuario;
							$autor = null;
							$data = null;
								
							break;
						default: // Sin Accesos
							header('Location: /?c=Login&a=Index');
							break;
					}


					$arr["nRetorno"] = 1;


				} else {

					//echo "Datos Incorrectos";
					
					$arr["nRetorno"] = -1;
					$arr["cMensajeRetorno"] = "Datos Incorrectos";


				}
				
				// return $stm->fetch(PDO::FETCH_OBJ);

				return $arr;

			} catch (Exception $e) 
			{
				die($e->getMessage());
			}

	}

}
