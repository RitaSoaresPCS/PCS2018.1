<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';
	include_once 'Usuario.php';

	
	function getByIdDiscussaoMensagemDiscussao() {
		$id = $_POST['id'];
		$sql = "select mensagemdiscussao.id as idmsg, mensagemdiscussao.*, usuario.* from mensagemdiscussao join usuario on mensagemdiscussao.idUsuarioCriador = usuario.id AND mensagemdiscussao.idDiscussao=$id";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$idmsg = $row["idmsg"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$conteudo = $row["conteudo"];
				$dataEnvio = $row["dataEnvio"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$username = $row["username"];
				$nome = $row["nome"];
				$urlImagemPerfil = $row["urlImagemPerfil"];

				$s = "{'id': '$idmsg', 'idUsuarioCriador': '$idUsuarioCriador', 'conteudo': '$conteudo', 'dataEnvio': '$dataEnvio', 'dataUltimaEdicao': '$dataUltimaEdicao', 'username': '$username', 'nome': '$nome', 'urlImagemPerfil': '$urlImagemPerfil'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}

		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}
	
	
	function removerMensagemDiscussao() {
		$id = $_POST['id'];
		$sql = "Delete from MensagemDiscussao where id = $id";
		echo query_no_result($sql);
	}

	
	function adicionarMensagemDiscussao() {		
		$idUsuarioCriador = $_POST['idUsuarioCriador'];
		$idDiscussao = $_POST['idDiscussao'];
		$conteudo = $_POST['conteudo'];
		
		if ($idUsuarioCriador != null) { // usuário logado, mas ainda não verifica se pode criar na comunidade.
			$dataEnvio = date('Y-m-d');

			$sql = "INSERT INTO MensagemDiscussao VALUES (default, $idUsuarioCriador, $idDiscussao, '$conteudo', '$dataEnvio', null)";

			// Retorna um json com o resultado.
			echo query_no_result($sql);
			return;
		}
		echo "[]";
	}

	
	function editarMensagemDiscussao() {
		$id = $_POST['id'];
		$conteudo = $_POST['conteudo'];
		$dataUltimaEdicao = date('Y-m-d');
		
		$sql = "UPDATE MensagemDiscussao set conteudo = '$conteudo', dataUltimaEdicao = '$dataUltimaEdicao' where id = $id";
		echo query_no_result($sql);
	}
	
	
	$func = $_POST['func'];

	switch ($func) {
		case "getByIdDiscussaoMensagemDiscussao":
			getByIdDiscussaoMensagemDiscussao();
			break;
		case "removerMensagemDiscussao":
			removerMensagemDiscussao();
			break;
		case "adicionarMensagemDiscussao":
			adicionarMensagemDiscussao();
			break;
		case "editarMensagemDiscussao":
			editarMensagemDiscussao();
			break;
	}

?>
