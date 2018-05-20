<?php
$func = $_POST['func'];

switch ($func) {
    case "adicionar":
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$dataCriacao = $_POST['dataCriacao'];
		$dataUltimaEdicao = $_POST['dataUltimaEdicao'];
		$tema = $_POST['tema'];	
		$ativa = $_POST['ativa'];	
		$idUsuarioAdministrador = $_POST['idUsuarioAdministrador'];	
	
		if( $xml = file_get_contents( '..\Dados\Comunidade.xml') ) {
			$xmldoc = new DomDocument( '1.0' );
			$xmldoc->preserveWhiteSpace = false;
			$xmldoc->formatOutput = true;

			$xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

			$root = $xmldoc->getElementsByTagName('Comunidade')->item(0);

			$comunidade = $xmldoc->createElement('comunidade');
			$root->appendChild($comunidade);


			$idElement = $xmldoc->createElement('id');
			$comunidade->appendChild($idElement);
			$idText = $xmldoc->createTextNode($id);
			$idElement->appendChild($idText);
			
			
			$nomeElement = $xmldoc->createElement('nome');
			$comunidade->appendChild($nomeElement);
			$nomeText = $xmldoc->createTextNode($nome);
			$nomeElement->appendChild($nomeText);
			
			
			$descricaoElement = $xmldoc->createElement('descricao');
			$comunidade->appendChild($descricaoElement);
			$descricaoText = $xmldoc->createTextNode($descricao);
			$descricaoElement->appendChild($descricaoText);
			
			
			$dataCriacaoElement = $xmldoc->createElement('dataCriacao');
			$comunidade->appendChild($dataCriacaoElement);
			$dataCriacaoText = $xmldoc->createTextNode($dataCriacao);
			$dataCriacaoElement->appendChild($dataCriacaoText);
			
			
			$dataUltimaEdicaoElement = $xmldoc->createElement('dataUltimaEdicao');
			$comunidade->appendChild($dataUltimaEdicaoElement);
			$dataUltimaEdicaoText = $xmldoc->createTextNode($dataUltimaEdicao);
			$dataUltimaEdicaoElement->appendChild($dataUltimaEdicaoText);
			
			
			$temaElement = $xmldoc->createElement('tema');
			$comunidade->appendChild($temaElement);
			$temaText = $xmldoc->createTextNode($tema);
			$temaElement->appendChild($temaText);
			
			
			$ativaElement = $xmldoc->createElement('ativa');
			$comunidade->appendChild($ativaElement);
			$ativaText = $xmldoc->createTextNode($ativa);
			$ativaElement->appendChild($ativaText);
			
			
			$idUsuarioAdministradorElement = $xmldoc->createElement('idUsuarioAdministrador');
			$comunidade->appendChild($idUsuarioAdministradorElement);
			$idUsuarioAdministradorText = $xmldoc->createTextNode($idUsuarioAdministrador);
			$idUsuarioAdministradorElement->appendChild($idUsuarioAdministradorText);

			$xmldoc->save('..\Dados\Comunidade.xml');
		}
		break;
		
	case "editar":
		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$dataUltimaEdicao = $_POST['dataUltimaEdicao'];
		$tema = $_POST['tema'];	
		$idUsuarioAdministrador = $_POST['idUsuarioAdministrador'];	
	
		$xml = simplexml_load_file( '..\Dados\Comunidade.xml');
		foreach($xml->comunidade as $com) {
			$idCom = (string)($com->id);
			
			if ($idCom == $id) {
				$com->nome = $nome;
				$com->descricao = $descricao;
				$com->dataUltimaEdicao = $dataUltimaEdicao;
				$com->tema = $tema;
				$com->idUsuarioAdministrador = $idUsuarioAdministrador;
				break;
			}
		}
		$xml->asXml('..\Dados\Comunidade.xml'); // Salva.
		break;
		
	case "remover":
		$id = $_POST['id'];
	
		$xml = simplexml_load_file( '..\Dados\Comunidade.xml');
		foreach($xml->comunidade as $com) {
			$idCom = (string)($com->id);
			
			if ($idCom == $id) {
				$com->ativa = "false";
				break;
			}
		}
		$xml->asXml('..\Dados\Comunidade.xml'); // Salva.

		break;
}

?>