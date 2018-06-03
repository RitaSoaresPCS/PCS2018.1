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
	
	
	function getUsuarioByIdComunidade() {
		$idComunidade = $_POST['idComunidade'];
		
		$sql = "select * from usuario join usuarioparceriacomunidade on Usuario.id = idUsuario and usuarioparceriacomunidade.idComunidade = $idComunidade";
		
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
	

	$func= $_POST['func'];

	switch ($func) {
		case "adicionar":
			adicionarUsuarioParceriaComunidade();
			break;
		case "remover":
			removerUsuarioParceriaComunidade();
			break;
		case "getUsuarioByIdComunidade":
			getUsuarioByIdComunidade();
			break;
	}

?>