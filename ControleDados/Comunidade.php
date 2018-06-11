<?php 
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';	
	
	function adicionarComunidade() {
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$dataCriacao = date('Y-m-d');
		$tema = $_POST['tema'];	
		$usernameAdmin = $_POST['usernameAdmin'];
		
		$_POST['func'] = "";
		include_once 'Usuario.php';
		
		$idUsuarioAdministrador = getIdUsuarioByUsername($usernameAdmin);
		
		$sql = "INSERT INTO Comunidade VALUES (default, '$nome', '$descricao', '$dataCriacao', null, '$tema', 1, $idUsuarioAdministrador)";
		
		// Retorna um json com o resultado.
		echo query_no_result($sql);
	}
	
	
	function listarComunidade() {		
		$sql = "SELECT * FROM Comunidade WHERE ativa = 1";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			
			// Para cada linha de resultado:
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];
				
				$s = "{'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema': '$tema'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		
		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}

	
	function getByIdComunidade() {
		$id = $_POST['id'];
		$sql = "SELECT * FROM Comunidade WHERE id = $id";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];
				$idUsuarioAdministrador = $row["idUsuarioAdministrador"];
				
				$s = "{ 'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema': '$tema', 'idUsuarioAdministrador': '$idUsuarioAdministrador'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo json_encode($return);
	}
	
	
	
	function getIdComunidadeByIdAdmin($idAdmin) {
		$sql = "SELECT id FROM Comunidade WHERE idUsuarioAdministrador = $idAdmin";
		
		$result = query_result($sql);
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				return $row["id"];
			}
		} 
		return "";
	}
	
	
	function getByNomeComunidade() {
		$nome = $_POST['nome'];
				
		$sql = "SELECT * FROM Comunidade WHERE LOWER(nome) LIKE LOWER('%$nome%')";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];
				
				$s = "{ 'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema':'$tema'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function getByDescricao() {
		$descricao = $_POST['descricao'];
				
		$sql = "SELECT * FROM Comunidade WHERE LOWER(descricao) LIKE LOWER('%$descricao%')";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];
				
				$s = "{ 'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema':'$tema'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function editarComunidade() {
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$dataUltimaEdicao = date('Y-m-d');
		$tema = $_POST['tema'];	
		$usernameAdmin = $_POST['usernameAdmin'];
		
		$_POST['func'] = "";
		include_once 'Usuario.php';
		
		$idUsuarioAdministrador = getIdUsuarioByUsername($usernameAdmin);
		
		$sql = "UPDATE Comunidade SET nome = '$nome', descricao = '$descricao', dataUltimaEdicao = '$dataUltimaEdicao', tema = '$tema', idUsuarioAdministrador = $idUsuarioAdministrador WHERE id = $id";
		
		echo query_no_result($sql);
	}
	
	
	function inativarComunidade() {
		$id = $_POST['id'];
		$sql = "UPDATE Comunidade SET ativa = 0 WHERE id = $id";
		echo query_no_result($sql);
	}

	
	$func = $_POST['func'];

	switch ($func) {
		case "adicionar":
			adicionarComunidade();
			break;
		case "listar":
			listarComunidade();
			break;
		case "getById":
			getByIdComunidade();
			break;
		case "getByNome":
			getByNomeComunidade();
			break;
		case "getByDescricao":
			getByDescricaoComunidade();
			break;
		case "editar":
			editarComunidade();
			break;
		case "inativar":
			inativarComunidade();
			break;
	}

?>