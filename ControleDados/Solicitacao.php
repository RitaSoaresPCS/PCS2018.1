<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';

	
	function listarSolicitacaoComunidade() {
		$idComunidade = $_POST['idComunidade'];
		
		$sql = "SELECT * FROM Solicitacao WHERE idReceptor=$idComunidade AND (tipo = 'visualizacaoComunidade' OR tipo = 'parceriaComunidade')";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idReceptor = $row["idReceptor"];
				$tipo = $row["tipo"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$aceita = $row["aceita"];
				$justificativa = $row["justificativa"];
				
				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idReceptor': '$idReceptor', 'tipo': '$tipo', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'aceita': '$aceita', 'justificativa': '$justificativa'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function getSolicitacaoComunidadeByNomeUsuario() {
		$idComunidade = $_POST['idComunidade'];
		$nome = $_POST['nome'];
		
		$sql = "SELECT Solicitacao.id AS idSolicitacao, Solicitacao.*, Usuario.* FROM Solicitacao JOIN Usuario ON Solicitacao.idUsuarioCriador = Usuario.id WHERE idReceptor=$idComunidade AND (tipo = 'visualizacaoComunidade' OR tipo = 'parceriaComunidade') AND LOWER(Usuario.nome) LIKE LOWER('%$nome%')";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$idSolicitacao = $row["idSolicitacao"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idReceptor = $row["idReceptor"];
				$tipo = $row["tipo"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$aceita = $row["aceita"];
				$justificativa = $row["justificativa"];
				
				$s = "{'idSolicitacao': '$idSolicitacao', 'idUsuarioCriador': '$idUsuarioCriador', 'idReceptor': '$idReceptor', 'tipo': '$tipo', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'aceita': '$aceita', 'justificativa': '$justificativa'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	

	$func= $_POST['func'];

	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
		switch ($func) {
			case "listarSolicitacaoComunidade":
				listarSolicitacaoComunidade();
				break;
			case "getSolicitacaoComunidadeByNomeUsuario":
				getSolicitacaoComunidadeByNomeUsuario();
				break;
		}
	}
?>