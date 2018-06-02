<?php
	$servername = "localhost:3306";
	$username = "root";
	$password = "";
	$dbname = "redesocial";


	function connect() {
		$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		if ($conn->connect_error) {
			die("Conexao falhou. Erro: " . $conn->connect_error);
		}
		return $conn;
	}
	
	function close($conn) {
		mysqli_close($conn);
	}

	
	function query_no_result($sql) {
		$conn = connect();
		
		$return = array();
		$return['erro'] = false;
		
		if (mysqli_query($conn, $sql)) {
			return json_encode($return);
		} else {
			$return['erro'] = true;
			$return['mensagem'] = $sql . mysqli_error($conn);
			return json_encode($return);
		}

		close($conn);	
	}
	
	
	function query_result($sql) {
		$conn = connect();
		
		$result = mysqli_query($conn, $sql);
		
		close($conn);

		return $result;
	}
	

?>