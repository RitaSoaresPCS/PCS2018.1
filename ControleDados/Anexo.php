<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';

	
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
	
	
	
	$func = $_POST['func'];

	switch ($func) {
		case "getAnexoByNomeEIdDiscussao":
			getAnexoByNomeEIdDiscussao();
			break;
		case "getAnexoByNomeEIdComunidade":
			getAnexoByNomeEIdComunidade();
			break;
	}
?>