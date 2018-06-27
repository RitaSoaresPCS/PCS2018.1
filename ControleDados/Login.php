<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';
	include_once 'Usuario.php';
	include_once 'Comunidade.php';
	
	$userId;

	class User {
		function __construct($id, $username, $email, $picture, $active, $instit, $title, $cpf, $name, $ban, $idLab, $idComuAdm){
			$this->id = $id;
			$this->username = $username;
			$this->email = $email;
			$this->picture = $picture;
			$this->active = $active;
			$this->instit = $instit;
			$this->title = $title;
			$this->cpf = $cpf;
			$this->name = $name;
			$this->ban = $ban;
			$this->idLab = $idLab;
			$this->idComuAdm = $idComuAdm;
		}
	}


	function login() {
		$email = $_POST['email'];
		$pass = $_POST['pass'];
		$hashPass = hash('sha256', $pass);
		
		$sql = "SELECT Comunidade.idUsuarioAdministrador as idAdminComunidade, Usuario.* FROM usuario JOIN Comunidade on Usuario.idComunidadePertence = comunidade.id WHERE email = '$email' and senha = '$hashPass' and banidoSistema = 0";
		
		$result = query_result($sql);
		$return = array();
		
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {

				
				$_SESSION['idUsuarioLogado'] = $row["id"];
				$_SESSION['idLaboratorioPertence'] = $row["idComunidadePertence"];
				
				if ($row["id"] == $row["idAdminComunidade"]) {
					$_SESSION['isAdminLab'] = "true";
				} else {
					$_SESSION['isAdminLab'] = "false";
				}
			
				if ($_SESSION['isAdminLab'] == "true" && $row["idComunidadePertence"] == "1") {
					$_SESSION['isAdminSistema'] = "true";
				}
				
				$id = $row["id"];
				$isAdminSistema = $_SESSION['isAdminSistema'];
				echo json_encode('{"id": "' . $id . '", "isAdminSistema":"' . $isAdminSistema . '"}');
				return;
			}
		} 
		echo ("[]");
		
	}
	
	
	function getData() {
		$idUser = $_POST['userId'];
		$_POST['id'] = $idUser;
		
		$jsonResult = getByIdUsuario();
		$userFound = json_decode($jsonResult);
		
		if (!(empty($userFound))) {
			$usuario = new User($userFound["id"], $userFound["username"], $userFound["email"], $userFound["urlImagemPerfil"], $userFound["ativo"], $userFound["instituicaoOrigem"], $userFound["titulo"], $userFound["cpf"], $userFound["nome"],$userFound["idComunidadePertence"], getIdComunidadeByIdAdmin($userFound["id"]));
		}
		
		echo $userFound;
	}
  
  
	$func = $_POST['func'];

	switch ($func) {
		case "login":
			login();
			break;
		case "getData":
			getData();
			break;
	}
  
?>