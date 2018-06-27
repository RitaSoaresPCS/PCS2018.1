<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';
	include_once 'Login.php';

	function mudarFixo(){
		$discussaoId= $_POST['discussaoId'];
		$bool= $_POST['bool'];
		$sql= "UPDATE discussao SET fixa= $bool WHERE id= $discussaoId";
		echo query_no_result($sql);
	}

	function getDiscussaoDoLab(){	
		$labId= $_POST['labId'];
		
		// Ordenado pelas discussões fixas primeiro.
		$sql= "SELECT discussao.id as discId, discussao.titulo as discTitulo, discussao.*, usuario.* FROM discussao join usuario on usuario.id = discussao.idUsuarioCriador WHERE discussao.idComunidadePertence=$labId and ativa = 1 order by fixa desc";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {

			// Para cada linha de resultado:
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["discId"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$urlImagemPerfil = $row["urlImagemPerfil"];
				$username = $row["username"];
				
				$titulo = $row["discTitulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];
				

				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'urlImagemPerfil': '$urlImagemPerfil', 'username': '$username', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa':'$fixa', 'dataUltimaEdicao':'$dataUltimaEdicao', 'publica':'$publica' }";
				array_push($return, str_replace("'", "\"", $s));
			}
		}

		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}

	function criarDiscussao() {
		$idUsuarioCriador = $_POST['userId'];
		if ($idUsuarioCriador != null) { // usuário logado, mas ainda não verifica se pode criar na comunidade.
			$idComunidadePertence = $_POST['idComunidadePertence'];
			$titulo = $_POST['titulo'];
			$dataCriacao = date('Y-m-d');
			$descricao = $_POST['descricao'];
			$publica = $_POST['publica'];

			$sql = "INSERT INTO Discussao VALUES (default, $idUsuarioCriador, $idComunidadePertence, '$titulo', '$dataCriacao', '$descricao', 1, 0, null, '$publica')";

			// Retorna um json com o resultado.
			echo query_no_result($sql);
			return;
		}
		echo "[]";
	}


	function exibirDiscussoesGlobal() {
		// Apenas da comunidade global:
		$sql = "SELECT * FROM Discussao WHERE ativa = 1 AND idComunidadePertence = 1";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idComunidadePertence = $row["idComunidadePertence"];
				$titulo = $row["titulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];

				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa': '$fixa', 'dataUltimaEdicao': '$dataUltimaEdicao', 'publica': '$publica'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo json_encode("[" . implode(",", $return) . "]");
	}


	function listarDiscussao() {
		$sql = "SELECT * FROM Discussao WHERE ativa = 1";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {

			// Para cada linha de resultado:
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idComunidadePertence = $row["idComunidadePertence"];
				$titulo = $row["titulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];

				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa': '$fixa', 'dataUltimaEdicao': '$dataUltimaEdicao', 'publica': '$publica'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}

		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}


	function getByIdDiscussao() {
		$id = $_POST['id'];
		$sql = "SELECT * FROM Discussao WHERE id = $id";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$idComunidadePertence = $row["idComunidadePertence"];
				$titulo = $row["titulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];

				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'idComunidadePertence': '$idComunidadePertence', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa': '$fixa', 'dataUltimaEdicao': '$dataUltimaEdicao', 'publica': '$publica'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo json_encode($return);
	}


	function getByTituloDiscussao() {
		$titulo = $_POST['titulo'];
		$idComunidadePertence = $_POST['idComunidadePertence'];

		$sql = "SELECT discussao.id as discId, discussao.titulo as discTitulo, discussao.*, usuario.* FROM discussao join usuario on usuario.id = discussao.idUsuarioCriador WHERE discussao.idComunidadePertence=$idComunidadePertence and ativa = 1 and LOWER(discussao.titulo) LIKE LOWER('%$titulo%') order by fixa desc";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["discId"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$urlImagemPerfil = $row["urlImagemPerfil"];
				$username = $row["username"];
				
				$titulo = $row["discTitulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];
				

				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'urlImagemPerfil': '$urlImagemPerfil', 'username': '$username', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa':'$fixa', 'dataUltimaEdicao':'$dataUltimaEdicao', 'publica':'$publica' }";
				array_push($return, str_replace("'", "\"", $s));
			}
		}

		echo "[" . implode(",", $return) . "]";
	}


	function getByDescricaoDiscussao() {
		$descricao = $_POST['descricao'];
		$idComunidadePertence = $_POST['idComunidadePertence'];
		
		$sql = "SELECT discussao.id as discId, discussao.titulo as discTitulo, discussao.*, usuario.* FROM discussao join usuario on usuario.id = discussao.idUsuarioCriador WHERE discussao.idComunidadePertence=$idComunidadePertence and ativa = 1 and LOWER(descricao) LIKE LOWER('%$descricao%') order by fixa desc";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["discId"];
				$idUsuarioCriador = $row["idUsuarioCriador"];
				$urlImagemPerfil = $row["urlImagemPerfil"];
				$username = $row["username"];
				
				$titulo = $row["discTitulo"];
				$dataCriacao = $row["dataCriacao"];
				$descricao = $row["descricao"];
				$fixa = $row["fixa"];
				$dataUltimaEdicao = $row["dataUltimaEdicao"];
				$publica = $row["publica"];
				

				$s = "{'id': '$id', 'idUsuarioCriador': '$idUsuarioCriador', 'urlImagemPerfil': '$urlImagemPerfil', 'username': '$username', 'titulo': '$titulo', 'dataCriacao': '$dataCriacao', 'descricao': '$descricao', 'fixa':'$fixa', 'dataUltimaEdicao':'$dataUltimaEdicao', 'publica':'$publica' }";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo "[" . implode(",", $return) . "]";
	}


	function editarDiscussao() {
		$id = $_POST['id'];
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$publica = $_POST['publica'];
		$dataUltimaEdicao = date('Y-m-d');

		$sql = "UPDATE Discussao SET titulo = '$titulo', descricao = '$descricao', dataUltimaEdicao = '$dataUltimaEdicao', publica = '$publica' WHERE id = $id";

		echo query_no_result($sql);
	}


	function inativarDiscussao() {
		$id = $_POST['id'];
		$sql = "UPDATE Discussao SET ativa = 0 WHERE id = $id";
		echo query_no_result($sql);
	}


	$func = $_POST['func'];

	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
		switch ($func) {
			case "criarDiscussao":
				criarDiscussao();
				break;
			case "listarDiscussao":
				listarDiscussao();
				break;
			case "getByIdDiscussao":
				getByIdDiscussao();
				break;
			case "getByTituloDiscussao":
				getByTituloDiscussao();
				break;
			case "getByDescricaoDiscussao":
				getByDescricaoDiscussao();
				break;
			case "editarDiscussao":
				editarDiscussao();
				break;
			case "inativarDiscussao":
				inativarDiscussao();
				break;
			case "exibirDiscussoesGlobal":
				exibirDiscussoesGlobal();
				break;
			case "getDiscussaoDoLab":
				getDiscussaoDoLab();
				break;
			case "mudarFixo":
				mudarFixo();
				break;
		}
	}

?>
