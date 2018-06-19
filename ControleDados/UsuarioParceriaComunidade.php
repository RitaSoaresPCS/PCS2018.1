<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';
	
	
	function adicionarUsuarioParceriaComunidade() {
		$username = $_POST['username'];
		$idComunidade = $_POST['idComunidade'];
		
		$_POST['func'] = "";
		include_once 'Usuario.php';
		$idUsuario = getIdUsuarioByUsername($username);
		
		$sql = "INSERT INTO UsuarioParceriaComunidade VALUES ($idUsuario, $idComunidade)";
		
		// Retorna um json com o resultado.
		echo query_no_result($sql);
	}
	
	
	function removerUsuarioParceriaComunidade() {
		$username = $_POST['username'];
		$idComunidade = $_POST['idComunidade'];
		
		$_POST['func'] = "";
		include_once 'Usuario.php';
		
		$idUsuario = getIdUsuarioByUsername($username);

		$sql = "DELETE FROM UsuarioParceriaComunidade WHERE idUsuario = $idUsuario AND idComunidade = $idComunidade";
		
		// Retorna um json com o resultado.
		echo query_no_result($sql);		
	}
	
	
	function getParceiroByIdComunidade() {
		$idComunidade = $_POST['idComunidade'];
		
		$sql = "SELECT * FROM Usuario JOIN UsuarioParceriaComunidade ON Usuario.id = UsuarioParceriaComunidade.idUsuario AND UsuarioParceriaComunidade.idComunidade = $idComunidade";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			
			// Para cada linha de resultado:
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$username = $row["username"];
				$urlImagemPerfil = $row["urlImagemPerfil"];
				$instituicaoOrigem = $row["instituicaoOrigem"];
				$nome = $row["nome"];
				$idComunidadePertence = $row["idComunidadePertence"];
				
				$s = "{'id': '$id', 'username': '$username', 'urlImagemPerfil': '$urlImagemPerfil', 'instituicaoOrigem': '$instituicaoOrigem', 'nome': '$nome', 'idComunidadePertence': '$idComunidadePertence'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
				
		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
		
	}
	
	
	function getByNomeUsuarioParceriaComunidade() {
		$idComunidade = $_POST['idComunidade'];
		$nome = $_POST['nome'];
		
		$sql = "SELECT * FROM Usuario JOIN UsuarioParceriaComunidade ON Usuario.id = UsuarioParceriaComunidade.idUsuario AND UsuarioParceriaComunidade.idComunidade = $idComunidade AND LOWER(Usuario.nome) LIKE LOWER('%$nome%')";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$username = $row["username"];
				$urlImagemPerfil = $row["urlImagemPerfil"];
				$instituicaoOrigem = $row["instituicaoOrigem"];
				$nome = $row["nome"];
				$idComunidadePertence = $row["idComunidadePertence"];
				
				$s = "{'id': '$id', 'username': '$username', 'urlImagemPerfil': '$urlImagemPerfil', 'instituicaoOrigem': '$instituicaoOrigem', 'nome': '$nome', 'idComunidadePertence': '$idComunidadePertence'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	

	$func= $_POST['func'];

	switch ($func) {
		case "adicionarUsuarioParceriaComunidade":
			adicionarUsuarioParceriaComunidade();
			break;
		case "removerUsuarioParceriaComunidade":
			removerUsuarioParceriaComunidade();
			break;
		case "getParceiroByIdComunidade":
			getParceiroByIdComunidade();
			break;
		case "getByNomeUsuarioParceriaComunidade":
			getByNomeUsuarioParceriaComunidade();
			break;
	}

?>