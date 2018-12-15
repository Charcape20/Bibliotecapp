<?php
class Estado
{
	private $pdo;   
	
    public $id;
    public $nombre_estado;

	public function __CONSTRUCT()
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

	public function Listar()
	{
		try
		{
			//$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM estados");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM estados WHERE id = ?");
			          
			$stm->execute(array($id));
			
			return $stm->fetch(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE estados SET  
						nombre_estado = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre_estado
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Estado $data)
	{
		try 
		{
			$sql = "INSERT INTO estados (nombre_estado) 
			        VALUES (?)";

			$this->pdo->prepare($sql)
			     ->execute(
					array(
	                    $data->nombre_sexo)
				);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}