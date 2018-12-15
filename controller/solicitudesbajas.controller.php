<?php 

require_once 'model/solicitudesbajas.php';
require_once 'model/users.php';


class SolicitudesbajasController{

	private $model;



	public function __CONSTRUCT(){
		$this->model = new SolicitudesBajas();
		
	
	}

	public function Index(){

		require_once 'view/inicio/inicio.php';
		require_once 'view/solicitudesbaja/solicitudesbajas.php';
		require_once 'view/footer.php';
	}

	public function BusquedaBootGrid(){
		echo $this->model->BusquedaBootGrid();
	}

	public function Guardar(){
		$alm = new Solicitudesbajas();
		$alm->name_usuario = $_REQUEST['txtName'];
		$alm->email_usuario = $_REQUEST['txtEmail'];

		$alm->estado_solicitud_id= 3; //En estado de Espera
		$alm->estado_solicitud_nombre="En Espera";

		$this->model->RegistrarSolicitudesBajas($alm);
		
		header('Location: /?c=Usuario&a=BajaExitosa');
	}


	public function AprobarSolicitudBaja(){
		$id = $_REQUEST['id'];
		//Devuelve el email en forma de array
		$email = $this->model->DevolverEmail($id);
		//implode lo convierte en string
		$this->model->Aprobar($id,implode($email));
		header('Location: /?c=Solicitudesbajas&a=Index');
	}

	public function Anular(){
		$id = $_REQUEST['id'];
		$this->model->Eliminar($id);
		header('Location: /?c=Solicitudesbajas&a=Index');
	}

	
}

 ?>