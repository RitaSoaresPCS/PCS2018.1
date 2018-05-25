<?php
class Discussao {
  function __construct($id, $creator, $title, $creatnDate, $descriptn, $actv, $isFixd, $lastEdit, $isPublic){
    $this->id= $id;
    $this->creator= $creator;
    $this->title= $title;
    $this->creatnDate= $creatnDate;
    $this->descriptn= $descriptn;
    $this->actv= $actv;
    $this->isFixd= $isFixd;
    $this->lastEdit= $lastEdit;
    $this->isPublic= $isPublic;
  }
}
  $func= $_POST['function'];
  if ($func== 'exibirDiscussoesGlobal')
  {
    $xmlCD= simplexml_load_file( '..\Dados\ComunidadeDiscussao.xml');
    $xmlD= simplexml_load_file('..\Dados\Discussao.xml');
    $iterator= 0;
    $discussoesId= array();
    $discussoes= array();
    foreach($xmlCD->comunidadeDiscussao as $cd)
    {
      $comunidadeId= (String)($cd->idComunidade);
      if ($comunidadeId== '0')
      {
        $discussoesId[$iterator]= (String)($cd->idDiscussao);
        $iterator++;
      }
    }
    $iterator2= 0;
    $discussoesSize= count($discussoesId);
    foreach($xmlD->discussao as $d)
    {


      for($iterator= 0; $iterator< $discussoesSize; $iterator++)
      {
        if(((String)$d->id)== $discussoesId[$iterator])
        {
          $discussoes[$iterator2]= new Discussao(((String)($d->id)), ((String)($d->idUsuarioCriador)),
          ((String)($d->titulo)), ((String)($d->dataCriacao)), ((String)($d->descricao)),
          ((String)($d->ativa)), ((String)($d->fixa)),
          ((String)($d->dataUltimaEdicao)), ((String)($d->publica)));
          $iterator2++;
        }

      }
    }
    echo json_encode($discussoes);
  }

?>
