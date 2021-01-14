<?php

	function ConnectDB(){
		$host = "localhost";
		$db   = "restaurant_db";
		$user = "root";
		$pass = "";
		$charset = 'utf8mb4';
		$debug = "true";

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$options =
		[
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];

		try
		{
			$pdo = new PDO($dsn, $user, $pass, $options);
		}
		catch (\PDOException $e)
		{
			if ( $debug == 'true' ) {

				throw new \PDOException($e->getMessage(), (int)$e->getCode());

			} else {

				die();

			}

		}

		return $pdo;

	}

	function arrayToQuery($arrayValue) {
		$returnValue = '';
		foreach ($arrayValue as $key => $value) {
			$returnValue = $returnValue ."$key='$value'";
			if ($value !== end($arrayValue)) $returnValue = $returnValue ." AND ";
		}
		return $returnValue;
	}


	function DeleteRow($databaseConnection ,$tableName ,$primaryKeys){
		if (!is_array($primaryKeys)) return ("die");
		try {
		$queryValue = arrayToQuery($primaryKeys);

		$sql = "DELETE FROM $tableName WHERE $queryValue";
		$databaseConnection->exec($sql);

  	echo "Succesvol verwijderd";
	} catch(PDOException $e) {
	  echo $sql . "<br>" . $e->getMessage();
	}
		}

	function SelectRow($databaseConnection ,$tableName ,$primaryKeys) {
		if (!is_array($primaryKeys)) return 'Funtion SelectRow() $primaryKeys is not an array';
		try {
		$queryValue = arrayToQuery($primaryKeys);

		$sql = "SELECT * FROM $tableName WHERE $queryValue";

		$stmt = $databaseConnection->prepare($sql);
		  $stmt->execute();
		  return ($stmt->fetchAll());

		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
	}
	}

?>
