<?php
	include_once 'Base.php';

	function logout() {
		$_SESSION['idUsuarioLogado'] = "";
		$_SESSION['idLaboratorioPertence'] = "";
		$_SESSION['isAdminLab'] = "";
		$_SESSION['isAdminSistema'] = "";
	}

  
	$func = $_POST['func'];

	if ($_SESSION['idUsuarioLogado'] != "") { // Usuário no mínimo deve estar logado.
		switch ($func) {
			case "logout":
				logout();
				break;
		}
	}
  
?>