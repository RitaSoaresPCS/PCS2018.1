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

	

	$func = $_POST['func'];

	switch ($func) {
		case "getByIdDiscussaoMensagemDiscussao":
			getByIdDiscussaoMensagemDiscussao();
			break;
		case "removerMensagemDiscussao":
			removerMensagemDiscussao();
			break;
	}

?>
