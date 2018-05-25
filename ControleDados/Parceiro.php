<?php

$func= $_POST['function'];
if ($func=== 'adicionarParceiro')
{
  if( $xml = file_get_contents( '..\Dados\Parceria.xml') ) {
    $return = array();
    $return['erro'] = false;

    $xmldoc = new DomDocument( '1.0' );
    $xmldoc->preserveWhiteSpace = false;
    $xmldoc->formatOutput = true;

    $xmldoc->loadXML( $xml, LIBXML_NOBLANKS );

    $root = $xmldoc->getElementsByTagName('Parceria')->item(0);

    $parceria= $xmldoc->createElement('parceria');
    $root->appendChild($parceria);


    $xml = simplexml_load_file( '..\Dados\Usuario.xml');
    $username= $_POST['username'];
    foreach($xml->usuario as $us) {
      $usernameUs = (string)($us->username);

      if ($usernameUs == $username) {
        $idUs = (string)($us->id);
      }
    }

    $idElement = $xmldoc->createElement('id');
    $parceria->appendChild($idElement);
    $idText = $xmldoc->createTextNode('2');
    $idElement->appendChild($idText);


    $parceriaElement = $xmldoc->createElement('idUsuario');
    $parceria->appendChild($parceriaElement);
    $idUsuarioText = $xmldoc->createTextNode($idUs);
    $parceriaElement->appendChild($idUsuarioText);

    $idComunidade= $_POST['idCom'];
    $parceriaElement = $xmldoc->createElement('idComunidade');
    $parceria->appendChild($parceriaElement);
    $idComunidadeText = $xmldoc->createTextNode($idComunidade);
    $parceriaElement->appendChild($idComunidadeText);

    $xmldoc->save('..\Dados\Parceria.xml');

    die(json_encode($return));

  }
}else{
  if ($func=== 'removerParceiro')
  {
    foreach($xml->parceria as $parceria) {
      $idParceria = (string)($parceria->id);

      if ($idParceria == $id) {
        $parceria->id = '';
        $parceria->idUsuario = '';
        $parceria->idComunidade = '';
        break;
      }
    }
  }

}

?>
