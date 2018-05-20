<?php
function existeUsernameOuEmail($username, $email) {
	$xml = simplexml_load_file( '..\Dados\Usuario.xml');
	foreach($xml->usuario as $us) {
		$usernameUs = (string)($us->username);
		$emailUs = (string)($us->email);
		
		if (($usernameUs == $username) || 
			($emailUs == $email)) {
			return true;
		}
	}
}


function existeUsernameOuEmailEdicao($username, $email, $id) {
	$xml = simplexml_load_file( '..\Dados\Usuario.xml');
	foreach($xml->usuario as $us) {
		$usernameUs = (string)($us->username);
		$emailUs = (string)($us->email);
		$idUs = (string)($us->id);
		
		if ((($usernameUs == $username) || ($emailUs == $email)) && ($idUs != $id)) {
			return true;
		}
	}
}

$func = $_POST['func'];

switch ($func) {
    case "adicionar":
		$id = $_POST['id'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$urlImagemPerfil = $_POST['urlImagemPerfil'];
		$ativo = $_POST['ativo'];
		$instituicaoOrigem = $_POST['instituicaoOrigem'];
		$titulo = $_POST['titulo'];
		$cpf = $_POST['cpf'];
		$nome = $_POST['nome'];
		$banidoSistema = $_POST['banidoSistema'];
		$idComunidadePertence = $_POST['idComunidadePertence'];
		
	
		if( $xml = file_get_contents( '..\Dados\Usuario.xml') ) {
			$return = array();
			$return['erro'] = false;
			
			$xmldoc = new DomDocument( '1.0' );
			$xmldoc->preserveWhiteSpace = false;
			$xmldoc->formatOutput = true;

			$xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

			$root = $xmldoc->getElementsByTagName('Usuario')->item(0);
			
			if (existeUsernameOuEmail($username, $email)) {
				$return['erro'] = true;
				$return['mensagem'] = "Já existe usuário com este e-mail ou username.";
				die(json_encode($return));
			}
			
			$usuario = $xmldoc->createElement('usuario');
			$root->appendChild($usuario);


			$idElement = $xmldoc->createElement('id');
			$usuario->appendChild($idElement);
			$idText = $xmldoc->createTextNode($id);
			$idElement->appendChild($idText);
			
			
			$usernameElement = $xmldoc->createElement('username');
			$usuario->appendChild($usernameElement);
			$usernameText = $xmldoc->createTextNode($username);
			$usernameElement->appendChild($usernameText);
			
			
			$emailElement = $xmldoc->createElement('email');
			$usuario->appendChild($emailElement);
			$emailText = $xmldoc->createTextNode($email);
			$emailElement->appendChild($emailText);
			
			
			$senha = substr(md5(rand()), 0, 7);
			$senhaElement = $xmldoc->createElement('senha');
			$usuario->appendChild($senhaElement);
			$senhaText = $xmldoc->createTextNode(hash('sha256', $senha)); // Senha inicial é uma string aleatória.
			$senhaElement->appendChild($senhaText);
			
			
			$urlImagemPerfilElement = $xmldoc->createElement('urlImagemPerfil');
			$usuario->appendChild($urlImagemPerfilElement);
			$urlImagemPerfilText = $xmldoc->createTextNode($urlImagemPerfil);
			$urlImagemPerfilElement->appendChild($urlImagemPerfilText);

		
			$ativoElement = $xmldoc->createElement('ativo');
			$usuario->appendChild($ativoElement);
			$ativoText = $xmldoc->createTextNode($ativo);
			$ativoElement->appendChild($ativoText);
			
			
			$instituicaoOrigemElement = $xmldoc->createElement('instituicaoOrigem');
			$usuario->appendChild($instituicaoOrigemElement);
			$instituicaoOrigemText = $xmldoc->createTextNode($instituicaoOrigem);
			$instituicaoOrigemElement->appendChild($instituicaoOrigemText);
		

			$tituloElement = $xmldoc->createElement('titulo');
			$usuario->appendChild($tituloElement);
			$tituloText = $xmldoc->createTextNode($titulo);
			$tituloElement->appendChild($tituloText);
			
			
			$cpfElement = $xmldoc->createElement('cpf');
			$usuario->appendChild($cpfElement);
			$cpfText = $xmldoc->createTextNode($cpf);
			$cpfElement->appendChild($cpfText);

			$nomeElement = $xmldoc->createElement('nome');
			$usuario->appendChild($nomeElement);
			$nomeText = $xmldoc->createTextNode($nome);
			$nomeElement->appendChild($nomeText);
			
			$banidoSistemaElement = $xmldoc->createElement('banidoSistema');
			$usuario->appendChild($banidoSistemaElement);
			$banidoSistemaText = $xmldoc->createTextNode($banidoSistema);
			$banidoSistemaElement->appendChild($banidoSistemaText);
		
			
			$idComunidadePertenceElement = $xmldoc->createElement('idComunidadePertence');
			$usuario->appendChild($idComunidadePertenceElement);
			$idComunidadePertenceText = $xmldoc->createTextNode($idComunidadePertence);
			$idComunidadePertenceElement->appendChild($idComunidadePertenceText);
		

			
			// Envio de email para o novo usuário cadastrado, com a $senha e $username.
			// Valida o e-mail primeiro, depois tenta enviar. Portanto, aqui pode retornar dois erros possíveis:
			//$return['erro'] = true;
			//$return['mensagem'] = "E-mail inválido."; ou $return['mensagem'] = "Não foi possível enviar e-mail, usuário não criado";
			// Somente salva o arquivo se o e-mail for enviado com sucesso.
			$xmldoc->save('..\Dados\Usuario.xml');
			
			die(json_encode($return));
			
		}
		break;
		
		
	case "editar":
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
		
		if (existeUsernameOuEmailEdicao($username, $email, $id)) {
			$return['erro'] = true;
			$return['mensagem'] = "Já existe usuário com este e-mail ou username.";
			die(json_encode($return));
		}

		$xml = simplexml_load_file( '..\Dados\Usuario.xml');
		
		foreach($xml->usuario as $us) {
			$idUs = (string)($us->id);
			
			if ($idUs == $id) {				
				$us->username = $username;
				$us->email = $email;
				$us->instituicaoOrigem = $instituicaoOrigem;
				$us->titulo = $titulo;
				$us->cpf = $cpf;
				$us->nome = $nome;
				$us->idComunidadePertence = $idComunidadePertence;
				break;
			}
		}
		$xml->asXml('..\Dados\Usuario.xml'); // Salva.
		die(json_encode($return));
		break;
		
	case "inativar":
		$id = $_POST['id'];
	
		$xml = simplexml_load_file( '..\Dados\Usuario.xml');
		foreach($xml->usuario as $us) {
			$idUs = (string)($us->id);
			
			if ($idUs == $id) {
				$us->ativo = "false";
				$us->banidoSistema = "true";
				break;
			}
		}
		
		$xml->asXml('..\Dados\Usuario.xml'); // Salva.

		break;
}

?>