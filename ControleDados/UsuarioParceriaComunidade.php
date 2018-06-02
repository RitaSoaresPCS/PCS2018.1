<?php
	include_once 'Base.php';
	include_once 'Usuario.php';
	
	
	function adicionarUsuarioParceriaComunidade() {
		$username = $_POST['username'];
		$idComunidade = $_POST['idComunidade'];
		$idUsuario = getIdUsuarioByUsername($username);
		
		$sql = "INSERT INTO UsuarioParceriaComunidade VALUES ($idUsuario, $idComunidade)";
		
		// Retorna um json com o resultado.
		echo query_no_result($sql);
	}
	
	
	function removerUsuarioParceriaComunidade() {
		$username = $_POST['username'];
		$idComunidade = $_POST['idComunidade'];
		$idUsuario = getIdUsuarioByUsername($username);

		$sql = "DELETE FROM UsuarioParceriaComunidade WHERE idUsuario = $idUsuario AND idComunidade = $idComunidade";
		
		// Retorna um json com o resultado.
		echo query_no_result($sql);		
	}
	

	$func= $_POST['func'];

	switch ($func) {
		case "adicionar":
			adicionarUsuarioParceriaComunidade();
			break;
		case "remover":
			removerUsuarioParceriaComunidade();
			break;
	}

?>