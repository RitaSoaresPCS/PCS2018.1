<?php
	include_once 'Base.php';

	
	function adicionarUsuario() {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$instituicaoOrigem = $_POST['instituicaoOrigem'];
		$titulo = $_POST['titulo'];
		$cpf = $_POST['cpf'];
		$nome = $_POST['nome'];
		$idComunidadePertence = $_POST['idComunidadePertence'];

		$return = array();
		$return['erro'] = false;			
			
		if (existeUsernameOuEmail($username, $email)) {
			$return['erro'] = true;
			$return['mensagem'] = "Já existe usuário com este e-mail ou username.";
			echo json_encode($return);
			return;
		}

		$senha = substr(md5(rand()), 0, 7);
		$senhaHash = hash('sha256', $senha); // Senha inicial é uma string aleatória.		
		
		// Envio de email para o novo usuário cadastrado, com a $senha e $username.
		// Valida o e-mail primeiro, depois tenta enviar. Portanto, aqui pode retornar dois erros possíveis:
		//$return['erro'] = true;
		//$return['mensagem'] = "E-mail inválido."; ou $return['mensagem'] = "Não foi possível enviar e-mail, usuário não criado";
		// Somente salva o arquivo se o e-mail for enviado com sucesso.

		$sql = "INSERT INTO Usuario VALUES (default, '$username', '$email', '$senhaHash', '', 1, '$instituicaoOrigem', $titulo, $cpf, $nome, 0, $idComunidadePertence)";
		
		// Retorna um json com o resultado.
		echo query_no_result($sql);
	}
	
	
	function listarUsuario() {
		// ativo é se já entrou no sistema.
		$sql = "SELECT * FROM Usuario WHERE ativo = 1 and banidoSistema = 0";
		
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
				array_push($return, str_replace("'", "\"", utf8_encode($s)));
			}
		} 
				
		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}


	function getByIdUsuario() {
		$id = $_POST['id'];
		$sql = "SELECT * FROM usuario WHERE id = $id";
		
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
				array_push($return, str_replace("'", "\"", utf8_encode($s)));
			}
		} 
		echo json_encode($return);
	}
	
	
	function getByNomeUsuario() {
		$nome = $_POST['nome'];
				
		$sql = "SELECT * FROM Usuario WHERE LOWER(nome) LIKE LOWER('%$nome%')";
		
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
				array_push($return, str_replace("'", "\"", utf8_encode($s)));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function getByNomeIgualUsuario() {
		$nome = $_POST['nome'];
				
		$sql = "SELECT * FROM Usuario WHERE LOWER(nome) = LOWER('$nome')";
		
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
				array_push($return, str_replace("'", "\"", utf8_encode($s)));
			}
		} 
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function getByUsernameUsuario() {
		$username = $_POST['username'];
				
		$sql = "SELECT * FROM Usuario WHERE LOWER(username) = LOWER('$username')";
		
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
				array_push($return, str_replace("'", "\"", utf8_encode($s)));
			}
		} 
		echo json_encode($return);
	}
	
	
	function getIdUsuarioByUsername($username) {
		$sql = "SELECT id FROM Usuario WHERE LOWER(username) = LOWER('$username')";
		
		$result = query_result($sql);
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				return $row["id"];
			}
		} 
		return "";
	}
	
	
	function editarUsuario() {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$instituicaoOrigem = $_POST['instituicaoOrigem'];
		$titulo = $_POST['titulo'];
		$cpf = $_POST['cpf'];
		$nome = $_POST['nome'];
		$idComunidadePertence = $_POST['idComunidadePertence'];

		$return = array();
		$return['erro'] = false;
		
		if (existeUsernameOuEmail($username, $email, $id)) {
			$return['erro'] = true;
			$return['mensagem'] = "Já existe usuário com este e-mail ou username.";
			echo json_encode($return);
		}
		
		$sql = "UPDATE Usuario SET username = '$username', email = '$email', instituicaoOrigem = '$instituicaoOrigem', titulo = '$titulo', cpf = '$cpf', nome = '$nome', idComunidadePertence = '$idComunidadePertence' WHERE id = $id";
		
		echo query_no_result($sql);
	}
	
	
	function inativarUsuario() {
		$id = $_POST['id'];
		// colocar ativo = 0 ?
		$sql = "UPDATE Usuario SET banidoSistema = 'true' WHERE id = $id";
		echo query_no_result($sql);
	}
	
	
	function existeUsernameOuEmail($username, $email, $id = -1) {
		$sql = "SELECT * FROM Usuario WHERE (username=$username or email=$email) and id != $id";
		
		$result = query_result($sql);
		
		if (mysqli_num_rows($result) > 0) {
			return true;
		} 
		return false;
	}
		
	
	$func = $_POST['func'];

	switch ($func) {
		case "adicionar":
			adicionarUsuario();
			break;
		case "listar":
			listarUsuario();
			break;
		case "getById":
			getByIdUsuario();
			break;
		case "getByNome":
			getByNomeUsuario();
			break;
		case "getByNomeIgual":
			getByNomeIgualUsuario();
			break;
		case "getByUsername":
			getByUsernameUsuario();
			break;
		case "editar":
			editarUsuario();
			break;
		case "inativar":
			inativarUsuario();
			break;
	}
?>