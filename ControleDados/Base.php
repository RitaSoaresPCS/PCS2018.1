<?php
	header('Content-Type: text/html; charset=utf-8');
	$servername = "localhost:3306";
	$username = "root";
	$password = "";
	$dbname = "redesocial";
	
	
	if(!session_id()) session_start();

	if(!isset($_SESSION['idUsuarioLogado'])) {
		$_SESSION['idUsuarioLogado'] = "";
	}
	if(!isset($_SESSION['idLaboratorioPertence'])) {
		$_SESSION['idLaboratorioPertence'] = "";
	}
	if(!isset($_SESSION['isAdminLab'])) {
		$_SESSION['isAdminLab'] = "";
	}
	if(!isset($_SESSION['isAdminSistema'])) {
		$_SESSION['isAdminSistema'] = "";
	}


	function connect() {
		$conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
		if ($conn->connect_error) {
			die("Conexao falhou. Erro: " . $conn->connect_error);
		}

		mysqli_set_charset($conn, 'utf8');
		mysqli_query($conn, "SET NAMES 'utf8'");
		mysqli_query($conn, 'SET character_set_connection=utf8');
		mysqli_query($conn, 'SET character_set_client=utf8');
		mysqli_query($conn, 'SET character_set_results=utf8');

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
	
	
	function query_return_id($sql) {
		$conn = connect();
		
		$last_id = 0;
		if (mysqli_query($conn, $sql)) {
			$last_id = mysqli_insert_id($conn);
		} 
		
		close($conn);
		return $last_id;
	}
	
	
	function query_result($sql) {
		$conn = connect();
		
		$result = mysqli_query($conn, $sql);
		
		close($conn);

		return $result;
	}
	
?>