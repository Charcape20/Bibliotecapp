<?php 

class Solicitudesbajas{

	public $pdo;
	public   $pdo_aux;
	public  $id;
	public $name_usuario;
	public $email_usuario;
	public  $estado_solicitud_id;
	public $estado_solicitud_nombre;


	public function __CONSTRUCT(){
		try {
			$this->pdo = Database::StartUp();
			$this->pdo_aux = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	
	public function RegistrarSolicitudesBajas(Solicitudesbajas $data){
		try 
		{
		$sql = "INSERT INTO solicitudesbajas(name_usuario,email_usuario,estado_solicitud_id,estado_solicitud_nombre) 
				VALUES (? , ? , ? , ?)";
		$this->pdo->prepare($sql)
			->execute(
					array(
							$data->name_usuario,
							$data->email_usuario,
							$data->estado_solicitud_id,
							$data->estado_solicitud_nombre
					)
			);
			
		} catch (Exception $e) 
		{
		die($e->getMessage());
		}
	}


	public function DevolverEmail($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT email_usuario FROM solicitudesbajas 
				WHERE id = ?");
			$stm->execute(array($id));
			$email= $stm->fetch(PDO::FETCH_ASSOC);
			return $email;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	

	public function BusquedaBootGrid(){

		$query = '';
		$records_per_page = 10;
		$start_from = 0;
		$current_page_number = -1;

		//OBservamos si existe la cantidad de lineas a mostrarse
		if (isset($_POST["rowCount"])) {
			# Entonces vemos la cantidad de lineas
			$records_per_page = $_POST["rowCount"];
		} else {
			$records_per_page = 10;
		}

		if (isset($_POST["current"])) {
			# Entonces
			$current_page_number = $_POST["current"];
		} else {
			$current_page_number = 1;
		}

		$start_from = ($current_page_number - 1) * $records_per_page;

		$query .= "SELECT id,name_usuario,email_usuario,estado_solicitud_id,estado_solicitud_nombre
			FROM solicitudesbajas WHERE estado_solicitud_id = 3" ;

		if (!empty($_POST["searchPhrase"])) {
			# Metodo de busqueda dentro del BOOTGRID
			$query .= 'WHERE (solicitudesbajas.id LIKE "%'.$_POST["searchPhrase"].'%")';
			$query .= 'WHERE (solicitudesbajas.name_usuario LIKE "%'.$_POST["searchPhrase"].'%")';
			$query .= 'WHERE (solicitudesbajas.email_usuario LIKE "%'.$_POST["searchPhrase"].'%")';
			
		}

		$order_by = '';

		if (isset($_POST["sort"]) && is_array($_POST["sort"])) {
			# Entonces
			foreach ( $_POST["sort"] as $key => $value) {
				# Entonces
				$order_by .= "$key $value,";
			}
		} else {
			$query .= " ORDER BY solicitudesbajas.id DESC";;
		}

		if ($order_by != '') {
			# Entonces 
			$query .= ' ORDER BY '. substr($order_by, 0, -2);
		}

		if ($records_per_page != -1) {
			# Entonces
			$query .= " LIMIT ". $start_from.",".$records_per_page.";";
		}
			// echo $query;
		try {
			$stm = $this->pdo->prepare($query);
			$stm->execute();

			$results = $stm->fetchAll(PDO::FETCH_ASSOC);

		// echo "<br>";
		// var_dump($results);
		} catch (Exception $e) {
			die($e->getMessage());
		}

		//$total_records = $this->DevuelveNumeroTotalBajas();
		$total_records = 1;

		$output = array(
			'current' => intval($current_page_number),
			'rowCount' => intval($records_per_page),
			'total' => intval($total_records),
			'rows' => $results
		);

		$total_records= null;
		$query = null;
		$records_per_page = null;
		$order_by = null;
		$start_from = null;

		// echo "Estas aquí";
		// var_dump($output);
		// echo "<br>";
		return json_encode($output);

	}

	public function DevuelveNumeroTotalBajas(){
		try {
			$stm = $this->pdo_aux->prepare("SELECT * FROM solicitudesbajas ");
			$stm->execute();

			$total = count($stm->fetchAll(PDO::FETCH_OBJ));
			return $total;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	

	public function Aprobar($id,$email){
		try {
			$sql = "UPDATE solicitudesbajas SET estado_solicitud_id = 2 WHERE id = ?";
			$sql2 = "UPDATE solicitudesbajas SET estado_solicitud_nombre = 'Aprobada' WHERE id = ?";
			$sql3 = "UPDATE users SET users_tipos_id = 4 WHERE emailid = ?";
			$this->pdo->prepare($sql)->execute(array($id));
			$this->pdo->prepare($sql2)->execute(array($id));
			$this->pdo_aux->prepare($sql3)->execute(array($email));	
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Eliminar($id){
		try {
			$sql = "UPDATE solicitudesbajas SET estado_solicitud_id = 1 WHERE id = ?";
			$sql2 = "UPDATE solicitudesbajas SET estado_solicitud_nombre = 'Anulada' WHERE id = ?";
			$this->pdo->prepare($sql)->execute(array($id));
			$this->pdo->prepare($sql2)->execute(array($id));

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
}


 ?>