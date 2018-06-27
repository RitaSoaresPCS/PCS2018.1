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
		$idUsuario = $_POST['idUsuario'];
		$idComunidade = $_POST['idComunidade'];

		$sql = "DELETE FROM UsuarioParceriaComunidade WHERE idUsuario = $idUsuario AND idComunidade = $idComunidade";
		
		// Retorna um json com o resultado.
		echo query_no_result($sql);		
	}
	
	
	function getParceiroByIdComunidade() {
		$idComunidade = $_POST['idComunidade'];
		
		$sql = "SELECT Comunidade.nome as nomeComunidade, Usuario.* FROM Usuario JOIN UsuarioParceriaComunidade ON Usuario.id = UsuarioParceriaComunidade.idUsuario join comunidade on uSUARIO.idComunidadePertence = comunidade.id where UsuarioParceriaComunidade.idComunidade = $idComunidade";
		
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
				
				
				$s = "{'id': '$id', 'username': '$username', 'urlImagemPerfil': '$urlImagemPerfil', 'instituicaoOrigem': '$instituicaoOrigem', 'nome': '$nome', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'nomeComunidade': '$nomeComunidade'}";
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
	
	
	function enviarConviteParceiro() {
		$idComunidade = $_POST['idComunidade'];
		$email = $_POST['email'];
		
		$sql = "SELECT * FROM Usuario WHERE email = '$email'";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$titulo = $row["titulo"];
				$id = $row["id"];
				
				if ($titulo == "aluno") {
					// Não é possível adicionar aluno como parceiro, deve ser adicionado como membro.
					$return['erro'] = true;
					$return['mensagem'] = "aluno";	
				} else {
					// Verifica se usuário já não é parceiro.
					$sql2 = "select * from usuarioparceriacomunidade where idUsuario = $id AND idComunidade = $idComunidade";
					$result2 = query_result($sql2);
		
					if (mysqli_num_rows($result2) > 0) {
						$return['erro'] = true;
						$return['mensagem'] = "parceiro";	
					} else {
						// Envio de e-mail - ainda não implementado.
						$return['erro'] = false;
					}
				}
			}
		} else {
			// Não existe usuário com o e-mail digitado. Pergunta se quer convidar mesmo assim. 
			$return['erro'] = true;
			$return['mensagem'] = "email";	
		}
		echo json_encode($return);
	}
	
	

	$func= $_POST['func'];

	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
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
			case "enviarConviteParceiro":
				enviarConviteParceiro();
				break;
		}
	}
?>