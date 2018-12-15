
<?php
class Sexo
{
	private $pdo;   
    public $id;
    public $nombre_sexo;

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

			$stm = $this->pdo->prepare("SELECT * FROM sexos");
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
			          ->prepare("SELECT * FROM sexos WHERE id = ?");
			          
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
			$sql = "UPDATE sexos SET  
						nombre_sexo = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre_sexo
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Sexo $data)
	{
		try 
		{
		$sql = "INSERT INTO sexos (nombre_sexo) 
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