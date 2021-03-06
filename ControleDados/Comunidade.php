<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';


	function permissaoEdicaoComunidade($id) {
		return ($_SESSION['isAdminSistema'] == "true" || 
			($_SESSION['isAdminLab'] == "true" && $_SESSION['idLaboratorioPertence'] == $id));
		
	}
	
	
	function getByNomeOuDescricaoComunidade(){
		$nome = $_POST['nome'];
		$descriptn= $_POST['descricao'];

		$sql = "SELECT * FROM Comunidade WHERE (LOWER(nome) LIKE LOWER('%$nome%') OR LOWER(descricao) LIKE LOWER('%$descriptn%')) and ativa = 1";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];

				$s = "{ 'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema':'$tema'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo "[" . implode(",", $return) . "]";
	}

	function removeAdm(){
		$admId = $_POST['admId'];
		$sql = "UPDATE comunidade SET idUsuarioAdministrador = NULL WHERE idUsuarioAdministrador = $admId";
		echo query_no_result($sql);
	}

	function setAdm(){
		$labName = $_POST['labName'];
		$admId = $_POST['admId'];
		$sql = "UPDATE comunidade SET idUsuarioAdministrador= $admId WHERE nome= '$labName'";
		echo query_no_result($sql);
	}

	function getByNomeIgualComunidade(){
		$name= $_POST['nome'];
		$sql= "SELECT id FROM comunidade WHERE nome= '$name'";
		echo json_encode(query_result($sql));
	}

	function getLabsDisponiveis(){
		$sql= "SELECT id, nome FROM comunidade WHERE idUsuarioAdministrador IS NULL AND ativa = 1";
		$result = query_result($sql);
		$return = array();
		if (mysqli_num_rows($result) > 0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$id= $row['id'];
				$name= $row['nome'];
				$s = "{'id': '$id', 'name': '$name'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo "[" . implode(",", $return) . "]";
	}

	function adicionarComunidade() {
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$dataCriacao = date('Y-m-d');
		$tema = $_POST['tema'];
		$usernameAdmin = $_POST['usernameAdmin'];

		$idUsuarioAdministrador = getIdUsuarioByUsername($usernameAdmin);

		// Adiciona o administrador como membro dessa comunidade.
		$sql = "INSERT INTO Comunidade VALUES (default, '$nome', '$descricao', '$dataCriacao', null, '$tema', 1, $idUsuarioAdministrador)";
		$last_id = query_return_id($sql);
		
		if ($last_id != 0) {
			$sql2 = "UPDATE Usuario SET idComunidadePertence = $last_id WHERE id = $idUsuarioAdministrador";
			echo query_no_result($sql2);
		}	
	}


	function listarComunidade() {
		$sql = "SELECT * FROM Comunidade WHERE ativa = 1";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {

			// Para cada linha de resultado:
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];

				$s = "{'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema': '$tema'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}

		// Retorna o array concatenado.
		echo "[" . implode(",", $return) . "]";
	}


	function getByIdComunidade() {
		$id = $_POST['id'];
		$sql = "SELECT * FROM Comunidade WHERE id = $id";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];
				$idUsuarioAdministrador = $row["idUsuarioAdministrador"];

				$s = "{ 'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema': '$tema', 'idUsuarioAdministrador': '$idUsuarioAdministrador'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo json_encode($return);
	}



	function getIdComunidadeByIdAdmin($idAdmin) {
		$sql = "SELECT id FROM Comunidade WHERE idUsuarioAdministrador = $idAdmin";

		$result = query_result($sql);

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				return $row["id"];
			}
		}
		return "";
	}


	function getByNomeComunidade() {
		$nome = $_POST['nome'];

		$sql = "SELECT * FROM Comunidade WHERE LOWER(nome) LIKE LOWER('%$nome%') and ativa = 1";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];

				$s = "{ 'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema':'$tema'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo "[" . implode(",", $return) . "]";
	}


	function getByDescricaoComunidade() {
		$descricao = $_POST['descricao'];

		$sql = "SELECT * FROM Comunidade WHERE LOWER(descricao) LIKE LOWER('%$descricao%') and ativa = 1";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$nome = $row["nome"];
				$descricao = $row["descricao"];
				$dataCriacao = $row["dataCriacao"];
				$tema = $row["tema"];

				$s = "{ 'id': '$id', 'nome': '$nome', 'descricao': '$descricao', 'dataCriacao': '$dataCriacao', 'tema':'$tema'}";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo "[" . implode(",", $return) . "]";
	}


	function editarComunidade() {
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$dataUltimaEdicao = date('Y-m-d');
		$tema = $_POST['tema'];
		$usernameAdmin = $_POST['usernameAdmin'];

		if (permissaoEdicaoComunidade($id)) {

			$idUsuarioAdministrador = getIdUsuarioByUsername($usernameAdmin);

			$sql = "UPDATE Comunidade SET nome = '$nome', descricao = '$descricao', dataUltimaEdicao = '$dataUltimaEdicao', tema = '$tema', idUsuarioAdministrador = $idUsuarioAdministrador WHERE id = $id";

			echo query_no_result($sql);
		} else {
			mensagemSemPermissao();
		}
		
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
	

	function inativarComunidade() {
		$id = $_POST['id'];
		if (permissaoEdicaoComunidade($id)) {
			$sql = "UPDATE Comunidade SET ativa = 0 WHERE id = $id";
			echo query_no_result($sql);
		} else {
			mensagemSemPermissao();
		}
	}
	
	
	function getMembrosComunidade() {
		$id = $_POST['id'];
		$sql = "SELECT * FROM Usuario WHERE idComunidadePertence = $id and ativo = 1 and banidoSistema = 0";

		$result = query_result($sql);
		$return = array();

		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$urlImagemPerfil = $row["urlImagemPerfil"];
				$nome = $row["nome"];

				$s = "{ 'id': '$id', 'urlImagemPerfil': '$urlImagemPerfil', 'nome': '$nome' }";
				array_push($return, str_replace("'", "\"", $s));
			}
		}
		echo json_encode($return);
	}

	

	$func = $_POST['func'];

	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
		switch ($func) {
			case "adicionarComunidade":
				if ($_SESSION['isAdminSistema'] == "true") {
					adicionarComunidade();
				} else {
					mensagemSemPermissao();
				}
				break;
			case "listarComunidade":
				listarComunidade();
				break;
			case "getByIdComunidade":
				getByIdComunidade();
				break;
			case "getByNomeComunidade":
				getByNomeComunidade();
				break;
			case "getByDescricaoComunidade":
				getByDescricaoComunidade();
				break;
			case "editarComunidade":
				editarComunidade();
				break;
			case "inativarComunidade":
				inativarComunidade();
				break;
			case "getLabsDisponiveis":
				getLabsDisponiveis();
				break;
			case "getByNomeIgualComunidade":
				getByNomeIgualComunidade();
				break;
			case "setAdm":
				if ($_SESSION['isAdminSistema'] == "true") {
					setAdm();
				} else {
					mensagemSemPermissao();
				}
				break;
			case "removeAdm":
				if ($_SESSION['isAdminSistema'] == "true") {
					removeAdm();
				} else {
					mensagemSemPermissao();
				}
				break;
			case "getByNomeOuDescricaoComunidade":
				getByNomeOuDescricaoComunidade();
				break;
			case "getMembrosComunidade":
				getMembrosComunidade();
				break;
		}
	}

?>
