<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';

	
	function getAnexoByIdDiscussao() {
		$idDiscussao = $_POST['idDiscussao'];
			
		$sql = "SELECT * FROM DiscussaoAcessaRecurso JOIN Recurso ON Recurso.id = DiscussaoAcessaRecurso.idRecurso WHERE DiscussaoAcessaRecurso.idDiscussao = $idDiscussao AND Recurso.publico = 1";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$idRecurso = $row["idRecurso"];
				$titulo = $row["titulo"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$dataEnvio = $row["dataEnvio"];
				$tamanhoMB = $row["tamanhoMB"];
				$publico = $row["publico"];
				$tipo = $row["tipo"];
				
				$s = "{'idRecurso': '$idRecurso', 'titulo': '$titulo', 'idUsuarioCriador': '$idUsuarioCriador', 'dataEnvio': '$dataEnvio', 'tamanhoMB': '$tamanhoMB', 'publico': '$publico', 'tipo': '$tipo'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	
	function getAnexoByNomeEIdDiscussao() {
		$nome = $_POST['nome'];
		$idDiscussao = $_POST['idDiscussao'];
			
		$sql = "SELECT * FROM DiscussaoAcessaRecurso JOIN Recurso ON Recurso.id = DiscussaoAcessaRecurso.idRecurso WHERE LOWER(Recurso.titulo) LIKE LOWER('%$nome%') AND DiscussaoAcessaRecurso.idDiscussao = $idDiscussao AND Recurso.publico = 1";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$idRecurso = $row["idRecurso"];
				$titulo = $row["titulo"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$dataEnvio = $row["dataEnvio"];
				$tamanhoMB = $row["tamanhoMB"];
				$publico = $row["publico"];
				$tipo = $row["tipo"];
				
				$s = "{'idRecurso': '$idRecurso', 'titulo': '$titulo', 'idUsuarioCriador': '$idUsuarioCriador', 'dataEnvio': '$dataEnvio', 'tamanhoMB': '$tamanhoMB', 'publico': '$publico', 'tipo': '$tipo'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function getAnexoByNomeEIdComunidade() {
		$nome = $_POST['nome'];
		$idComunidade = $_POST['idComunidade'];
				
		$sql = "SELECT * FROM ComunidadeAcessaRecurso JOIN Recurso ON Recurso.id = ComunidadeAcessaRecurso.idRecurso WHERE LOWER(Recurso.titulo) LIKE LOWER('%$nome%') AND ComunidadeAcessaRecurso.idComunidade = $idComunidade AND Recurso.publico = 1";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$idRecurso = $row["idRecurso"];
				$titulo = $row["titulo"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$dataEnvio = $row["dataEnvio"];
				$tamanhoMB = $row["tamanhoMB"];
				$publico = $row["publico"];
				$tipo = $row["tipo"];
				
				$s = "{'idRecurso': '$idRecurso', 'titulo': '$titulo', 'idUsuarioCriador': '$idUsuarioCriador', 'dataEnvio': '$dataEnvio', 'tamanhoMB': '$tamanhoMB', 'publico': '$publico', 'tipo': '$tipo'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function uploadFileDiscussao(){
		$idUsuario = $_POST['idUsuario'];
		$idDiscussao = $_POST['idDiscussao'];
		$dataEnvio = date('Y-m-d');
		
		if (isset($_FILES["fileToUpload"])) {
			$target_dir = "../Assets/Uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$newfilename = round(microtime(true)) . '-' . basename($_FILES["fileToUpload"]["name"], pathinfo($target_file,PATHINFO_EXTENSION));
			$target_file = $target_dir . $newfilename . $fileType;

			$result = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			
			$sql = "INSERT INTO recurso VALUES(DEFAULT, '$target_file', $idUsuario, '$dataEnvio', null, 1, '')";
			$idRecurso = query_return_id($sql);
			
			$sql2 = "INSERT INTO discussaoacessarecurso VALUES($idDiscussao, $idRecurso)";
			echo query_no_result($sql2);
		}
	}
	
	
	function removerAnexoDiscussao(){
		$idAnexo = $_POST['idAnexo'];
		$idDiscussao = $_POST['idDiscussao'];
		
		$sql = "delete from discussaoacessarecurso where idDiscussao=$idDiscussao and idRecurso=$idAnexo";
		echo query_no_result($sql);
	}
	
	
	
	$func = $_POST['func'];

	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
		switch ($func) {
			case "getAnexoByNomeEIdDiscussao":
				getAnexoByNomeEIdDiscussao();
				break;
			case "getAnexoByNomeEIdComunidade":
				getAnexoByNomeEIdComunidade();
				break;
			case "uploadFileDiscussao":
				uploadFileDiscussao();
				break;
			case "getAnexoByIdDiscussao":
				getAnexoByIdDiscussao();
				break;
			case "removerAnexoDiscussao":
				removerAnexoDiscussao();
				break;
				
		}
	}
?>