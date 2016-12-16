<?php
// Récupère les propriétés de la base de données du site WordPress 
include_once "../wp-config.php";

class Base_donnees
{
	protected $data_base;

	function __construct()
	{
		try 
		{ 
			// Connexion au serveur MySql sur 1&1	
			$host_name  = DB_HOST;
			$database   = DB_NAME;
			$user_name  = DB_USER;
			$password   = DB_PASSWORD;
			// Connection à la base de données
			$this->data_base = new PDO("mysql:host=$host_name; dbname=$database;", 
								       $user_name, 
								       $password);
 
			// Connexion au serveur MySql sur amen.fr	
			
			//$this->data_base = new PDO("mysql:host=localhost; "
			//                    .       "dbname=mh1fo6wb_test", 
			//					 'mh1fo6wb_oi', 
			//					 '/*-oi-*/');
			/*** echo a message saying we have connected ***/
			echo "Connecte a la base $database<hr>";
		}
		catch(PDOException $e)
		{
			echo '*** Erreur connexion base ***:<br>----> ', $e->getMessage();
			die();
		}
	}

	function exec_sql($sql)
	{
		try 
		{
		    echo $sql, '<br>';
			/*** fetch into an PDOStatement object ***/	
			$stmt = $this->data_base->query($sql,PDO::FETCH_OBJ);
			if ($stmt != null) 
			{
				/*** echo number of columns ***/
				$result = $stmt->fetch(PDO::FETCH_OBJ);
			}
			else
			{
				$result = null;
			}
		}	
		catch(PDOException $e)
		{
			echo $e->getMessage(), '<br>';
			echo $sql, '<br>';
			die();
		}
		catch(Exception $e)
		{
			echo $e->getMessage(), '<br>';
			echo $sql, '<br>';
			die();
		}
		return $result;
	}	
}
?>