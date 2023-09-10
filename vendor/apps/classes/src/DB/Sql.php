<?php 

namespace Apps\DB;

class Sql {

	const HOSTNAME = "localhost";
	const USERNAME = "ecommerce";
	const PASSWORD = "ecommerce";
	const DBNAME = "db_ecommerce";

	private $conn;

	public function __construct(){

		//$this->conn = new \PDO("mysql:host=localhost;dbname=db_ecommerce", "ecommerce", "ecommerce");

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME,
			 Sql::USERNAME, 
			 Sql::PASSWORD
		);
		
	}

	private function setParams($statement, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value){

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	public function select($rawQuery, $params = array()):array{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>