<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';

	
	function criarDiscussao() {
		if ($GLOBALS['userId'] != null) { // usuário logado, mas ainda não verifica se pode criar na comunidade.
			$idUsuarioCriador = $GLOBALS['userId'];
			$idComunidadePertence = $_POST['idComunidadePertence'];
			$titulo = $_POST['titulo'];
			$dataCriacao = date('Y-m-d');
			$descricao = $_POST['descricao'];
			$publica = $_POST['publica'];
			
			$sql = "INSERT INTO Discussao VALUES (default, $idUsuarioCriador, $idComunidadePertence, '$titulo', '$dataCriacao', '$descricao', 1, 0, null, '$publica')";
			
			// Retorna um json com o resultado.
			echo query_no_result($sql);
			return;
		}
		echo "[]";
	}
	
	
	function exibirDiscussoesGlobal() {
		// Apenas da comunidade global:
		$sql = "SELECT * FROM Discussao WHERE ativa = 1 AND idComunidadePertence = 1";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idComunidadePertence = $row["idComunidadePertence"];
				$titulo = $row["titulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];
				
				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa': '$fixa', 'dataUltimaEdicao': '$dataUltimaEdicao', 'publica': '$publica'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 	
		echo json_encode("[" . implode(",", $return) . "]");
	}
	
	
	function listarDiscussao() {		
		$sql = "SELECT * FROM Discussao WHERE ativa = 1";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			
			// Para cada linha de resultado:
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idComunidadePertence = $row["idComunidadePertence"];
				$titulo = $row["titulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];
				
				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa': '$fixa', 'dataUltimaEdicao': '$dataUltimaEdicao', 'publica': '$publica'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		
		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}

	
	function getByIdDiscussao() {
		$id = $_POST['id'];
		$sql = "SELECT * FROM Discussao WHERE id = $id";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idComunidadePertence = $row["idComunidadePertence"];
				$titulo = $row["titulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];
				
				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa': '$fixa', 'dataUltimaEdicao': '$dataUltimaEdicao', 'publica': '$publica'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo json_encode($return);
	}
	
	
	function getByTituloDiscussao() {
		$titulo = $_POST['titulo'];
				
		$sql = "SELECT * FROM Discussao WHERE LOWER(titulo) LIKE LOWER('%$titulo%')";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idComunidadePertence = $row["idComunidadePertence"];
				$titulo = $row["titulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];
				
				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa': '$fixa', 'dataUltimaEdicao': '$dataUltimaEdicao', 'publica': '$publica'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function getByDescricaoDiscussao() {
		$descricao = $_POST['descricao'];
				
		$sql = "SELECT * FROM Discussao WHERE LOWER(descricao) LIKE LOWER('%$descricao%')";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idComunidadePertence = $row["idComunidadePertence"];
				$titulo = $row["titulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];
				
				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa': '$fixa', 'dataUltimaEdicao': '$dataUltimaEdicao', 'publica': '$publica'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function editarDiscussao() {
		$id = $_POST['id'];
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$publica = $_POST['publica'];
		$dataUltimaEdicao = date('Y-m-d');
		
		$sql = "UPDATE Discussao SET titulo = '$titulo', descricao = '$descricao', dataUltimaEdicao = '$dataUltimaEdicao', publica = '$publica' WHERE id = $id";
		
		echo query_no_result($sql);
	}
	
	
	function inativarDiscussao() {
		$id = $_POST['id'];
		$sql = "UPDATE Discussao SET ativa = 0 WHERE id = $id";
		echo query_no_result($sql);
	}

	
	$func = $_POST['func'];

	switch ($func) {
		case "criar":
			criarDiscussao();
			break;
		case "listar":
			listarDiscussao();
			break;
		case "getById":
			getByIdDiscussao();
			break;
		case "getByTitulo":
			getByTituloDiscussao();
			break;
		case "getByDescricao":
			getByDescricaoDiscussao();
			break;
		case "editar":
			editarDiscussao();
			break;
		case "inativar":
			inativarDiscussao();
			break;
		case "exibirDiscussoesGlobal":
			exibirDiscussoesGlobal();
			break;
	}

?>