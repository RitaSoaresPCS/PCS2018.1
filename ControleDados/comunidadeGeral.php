<?php
  $xmlCD= simplexml_load_file( '..\Dados\ComunidadeDiscussao.xml');
  $iterator= 0;
  var $discussoes;
  foreach($xmlCD->comunidadeDiscussao as $cd)
  {
    $comunidadeId= $cd->idComunidade;
    if ($comunidadeId=== '0')
  {

  }
}
?>
