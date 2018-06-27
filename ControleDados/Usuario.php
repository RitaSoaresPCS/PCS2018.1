<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';

	function verifyAdm($userId) {
		$sql= "SELECT idUsuarioAdministrador FROM comunidade WHERE idUsuarioAdministrador = $userId";
		$result= query_result($sql);
		if (mysqli_num_rows($result) > 0) {
			return 1;
		}else{
			return 0;
		}
	}

	function listarUsuariosPermissao(){
		// ativo é se já entrou no sistema.
		$sql = "select usuario.id, username, urlImagemPerfil, instituicaoOrigem, usuario.nome, idComunidadePertence, titulo, comunidade.nome as nomeComunidade from usuario, comunidade where usuario.idComunidadePertence = comunidade.id and Usuario.ativo = 1 and Usuario.banidoSistema = 0";

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
				$titulo = $row["titulo"];
				$nomeComunidade = $row["nomeComunidade"];
				if ($titulo != 'aluno')
				{
					$isAdm= verifyAdm($id);
				}else{
					$isAdm= -1;
				}
				$s = "{'id': '$id', 'username': '$username', 'urlImagemPerfil': '$urlImagemPerfil', 'instituicaoOrigem': '$instituicaoOrigem', 'nome': '$nome', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'nomeComunidade': '$nomeComunidade', 'isAdm':'$isAdm' }";
				array_push($return, str_replace("'", "\"", $s));
			}
		}

		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}

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

		$sql = "INSERT INTO Usuario VALUES (default, '$username', '$email', '$senhaHash', '', 1, '$instituicaoOrigem', '$titulo', '$cpf', '$nome', 0, $idComunidadePertence)";

		// Retorna um json com o resultado.
		echo query_no_result($sql);
	}


	function listarUsuario() {
		// ativo é se já entrou no sistema.
		$sql = "select usuario.id, username, urlImagemPerfil, instituicaoOrigem, usuario.nome, idComunidadePertence, titulo, comunidade.nome as nomeComunidade from usuario, comunidade where usuario.idComunidadePertence = comunidade.id and Usuario.ativo = 1 and Usuario.banidoSistema = 0";

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
				$titulo = $row["titulo"];
				$nomeComunidade = $row["nomeComunidade"];

				$s = "{'id': '$id', 'username': '$username', 'urlImagemPerfil': '$urlImagemPerfil', 'instituicaoOrigem': '$instituicaoOrigem', 'nome': '$nome', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'nomeComunidade': '$nomeComunidade' }";
				array_push($return, str_replace("'", "\"", $s));
			}
		}

		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}


	function getByIdUsuario() {
		$id = $_POST['id'];
		$sql = "select usuario.id, username, urlImagemPerfil, instituicaoOrigem, usuario.nome, idComunidadePertence, titulo, comunidade.nome as nomeComunidade, email, cpf FROM usuario, comunidade where usuario.idComunidadePertence = comunidade.id and usuario.id = $id";
		
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
				$titulo = $row["titulo"];
				$nomeComunidade = $row["nomeComunidade"];
				$email = $row["email"];
				$cpf = $row["cpf"];

				$s = "{'id': '$id', 'username': '$username', 'urlImagemPerfil': '$urlImagemPerfil', 'instituicaoOrigem': '$instituicaoOrigem', 'nome': '$nome', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'nomeComunidade': '$nomeComunidade', 'email': '$email', 'cpf': '$cpf' }";

				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo json_encode($return);
	}


	function getByNomeUsuario() {
		$nome = $_POST['nome'];


		$sql = "select usuario.id, username, urlImagemPerfil, instituicaoOrigem, usuario.nome, idComunidadePertence, titulo, comunidade.nome as nomeComunidade from usuario, comunidade where usuario.idComunidadePertence = comunidade.id and Usuario.ativo = 1 and Usuario.banidoSistema = 0 and LOWER(usuario.nome) LIKE LOWER('%$nome%')";

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
				$titulo = $row["titulo"];
				$nomeComunidade = $row["nomeComunidade"];
				if ($titulo != 'aluno')
				{
					$isAdm= verifyAdm($id);
				}else{
					$isAdm= -1;
				}
				$s = "{'id': '$id', 'username': '$username', 'urlImagemPerfil': '$urlImagemPerfil', 'instituicaoOrigem': '$instituicaoOrigem', 'nome': '$nome', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'nomeComunidade': '$nomeComunidade', 'isAdm':'$isAdm' }";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo "[" . implode(",", $return) . "]";
	}


	function getByNomeIgualUsuario() {
		$nome = $_POST['nome'];

		$sql = "SELECT * FROM Usuario WHERE LOWER(nome) = LOWER('$nome') and ativo = 1 and banidoSistema = 0";

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


	function getByUsernameUsuario() {
		$username = $_POST['username'];

		$sql = "SELECT * FROM Usuario WHERE LOWER(username) = LOWER('$username') and ativo = 1 and banidoSistema = 0";

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
		echo json_encode($return);
	}


	function getIdUsuarioByUsername($username) {
		$sql = "SELECT id FROM Usuario WHERE LOWER(username) = LOWER('$username') and ativo = 1 and banidoSistema = 0";

		$result = query_result($sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				return $row["id"];
			}
		}
		return "";
	}


	function editarUsuario() {
		$id = $_POST['id'];
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
			return;
		}

		$sql = "UPDATE Usuario SET username = '$username', email = '$email', instituicaoOrigem = '$instituicaoOrigem', titulo = '$titulo', cpf = '$cpf', nome = '$nome', idComunidadePertence = '$idComunidadePertence' WHERE id = $id";

		echo query_no_result($sql);
	}


	function inativarUsuario() {
		$id = $_POST['id'];
		// colocar ativo = 0 ?
		$sql = "UPDATE Usuario SET banidoSistema = 1 WHERE id = $id";
		echo query_no_result($sql);
	}


	function existeEmail($email) {
		$sql = "SELECT * FROM Usuario WHERE email='$email'";

		$result = query_result($sql);

		if (mysqli_num_rows($result) > 0) {
			return true;
		}
		return false;
	}


	function existeUsernameOuEmail($username, $email, $id = -1) {
		$sql = "SELECT * FROM Usuario WHERE (username='$username' or email='$email') and id != $id";

		$result = query_result($sql);

		if (mysqli_num_rows($result) > 0) {
			return true;
		}
		return false;
	}

	
	function enviarConviteMembro() {
		$idComunidade = $_POST['idComunidade'];
		$email = $_POST['email'];
		
		$sql = "SELECT * FROM Usuario WHERE email = '$email'";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				
				// Verifica se o usuário já não é membro.
				$sql2 = "select * from usuario where id = $id AND idComunidadePertence = $idComunidade";
				$result2 = query_result($sql2);
	
				if (mysqli_num_rows($result2) > 0) {
					$return['erro'] = true;
					$return['mensagem'] = "membro";	
				} else {
					// Envio de e-mail - ainda não implementado.
					$return['erro'] = false;	
				}
				
			}
		} else {
			// Não existe usuário com o e-mail digitado. Pergunta se quer convidar mesmo assim. 
			$return['erro'] = true;
			$return['mensagem'] = "email";	
		}
		echo json_encode($return);
	}
	
	

	$func = $_POST['func'];
	
	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
		switch ($func) {
			case "adicionarUsuario":
				adicionarUsuario();
				break;
			case "listarUsuario":
				listarUsuario();
				break;
			case "getByIdUsuario":
				getByIdUsuario();
				break;
			case "getByNomeUsuario":
				getByNomeUsuario();
				break;
			case "getByNomeIgualUsuario":
				getByNomeIgualUsuario();
				break;
			case "getByUsername":
				getByUsernameUsuario();
				break;
			case "editarUsuario":
				editarUsuario();
				break;
			case "inativarUsuario":
				inativarUsuario();
				break;
			case "listarUsuariosPermissao":
				listarUsuariosPermissao();
				break;
			case "enviarConviteMembro":
				enviarConviteMembro();
				break;
		}
	}
?>
