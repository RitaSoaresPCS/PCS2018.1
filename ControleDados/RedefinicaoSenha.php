<?php
	header('Content-Type: text/html; charset=utf-8');
	include_once 'Base.php';

	function redefinirSenha() {
		$email = $_POST['email'];
		
		$_POST['func'] = "";
		include_once 'Usuario.php';
		
		if (existeEmail($email)) {
			$senha = substr(md5(rand()), 0, 7);
			$senhaHash = hash('sha256', $senha);
			
			// Salva nova senha no banco:
			$sql = "UPDATE Usuario SET senha = '$senhaHash' WHERE email = '$email'";
			echo query_no_result($sql);
			
			// Envia por e-mail a nova senha:
			// Integração ainda não implementada.
		} else {
			echo ("[]");	
		}
	}
  
  
	$func = $_POST['func'];

	switch ($func) {
		case "redefinirSenha":
			redefinirSenha();
			break;
	}
  
?>