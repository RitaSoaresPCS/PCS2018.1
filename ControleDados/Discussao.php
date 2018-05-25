<?php
$func = $_POST['func'];

switch ($func) {
    case "criar":
		$id = $_POST['id'];
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$dataCriacao = $_POST['dataCriacao'];
		$dataUltimaEdicao = $_POST['dataUltimaEdicao'];
		$ativo = $_POST['ativo'];

		if( $xml = file_get_contents( '..\Dados\Discussao.xml') ) {
			$xmldoc = new DomDocument( '1.0' );
			$xmldoc->preserveWhiteSpace = false;
			$xmldoc->formatOutput = true;

			$xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

			$root = $xmldoc->getElementsByTagName('Discussao')->item(0);

			$discussao = $xmldoc->createElement('discussao');
			$root->appendChild($discussao);


			$idElement = $xmldoc->createElement('id');
			$discussao->appendChild($idElement);
			$idText = $xmldoc->createTextNode($id);
			$idElement->appendChild($idText);


			$tituloElement = $xmldoc->createElement('titulo');
			$discussao->appendChild($tituloElement);
			$tituloText = $xmldoc->createTextNode($titulo);
			$tituloElement->appendChild($tituloText);


			$descricaoElement = $xmldoc->createElement('descricao');
			$discussao->appendChild($descricaoElement);
			$descricaoText = $xmldoc->createTextNode($descricao);
			$descricaoElement->appendChild($descricaoText);


			$dataCriacaoElement = $xmldoc->createElement('dataCriacao');
			$discussao->appendChild($dataCriacaoElement);
			$dataCriacaoText = $xmldoc->createTextNode($dataCriacao);
			$dataCriacaoElement->appendChild($dataCriacaoText);


			$dataUltimaEdicaoElement = $xmldoc->createElement('dataUltimaEdicao');
			$discussao->appendChild($dataUltimaEdicaoElement);
			$dataUltimaEdicaoText = $xmldoc->createTextNode($dataUltimaEdicao);
			$dataUltimaEdicaoElement->appendChild($dataUltimaEdicaoText);

			$ativoElement = $xmldoc->createElement('ativo');
			$discussao->appendChild($ativoElement);
			$ativoText = $xmldoc->createTextNode($ativo);
			$ativoElement->appendChild($ativoText);

			$xmldoc->save('..\Dados\Discussao.xml');
		}
		break;

	case "editar":
		$id = $_POST['id'];
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$dataUltimaEdicao = $_POST['dataUltimaEdicao'];

		$xml = simplexml_load_file( '..\Dados\Discussao.xml');
		foreach($xml->discussao as $com) {
			$idCom = (string)($com->id);

			if ($idCom == $id) {
				$com->titulo = $titulo;
				$com->descricao = $descricao;
				$com->dataUltimaEdicao = $dataUltimaEdicao;
				break;
			}
		}
		$xml->asXml('..\Dados\Discussao.xml'); // Salva.
		break;

	case "inativar":
		$id = $_POST['id'];

		$xml = simplexml_load_file( '..\Dados\Discussao.xml');
		foreach($xml->discussao as $com) {
			$idCom = (string)($com->id);

			if ($idCom == $id) {
				$com->ativo = "false";
				break;
			}
		}
		$xml->asXml('..\Dados\Discussao.xml'); // Salva.

		break;
}

?>
