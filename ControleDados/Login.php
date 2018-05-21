<?php


  class User {
    function __construct($id, $username, $email, $picture, $active, $instit, $title, $cpf, $name, $ban, $idLab){
      $this->id= $id;
      $this->username= $username;
      $this->email= $email;
      $this->picture= $picture;
      $this->active= $active;
      $this->instit= $instit;
      $this->title= $title;
      $this->cpf= $cpf;
      $this->name= $name;
      $this->ban= $ban;
      $this->idLab= $idLab;
    }
  }



  $func= $_POST['function'];
  if ($func=== 'login')
  {
    $email= $_POST['email'];
    $pass= $_POST['pass'];
    $xml = simplexml_load_file( '..\Dados\Usuario.xml');
    foreach($xml->usuario as $user)
    {
      $userEmail= (String)($user->email);
      if ($email === $userEmail)
      {
          $userPass= (String)($user->senha);
          if ($pass === $userPass){
            $userId= (String)($user->id);
            echo json_encode($userId);
          }
      }
    }
  }else{
    if ($func=== 'getData')
    {
      $idUser= $_POST['userId'];
      $xml = simplexml_load_file( '..\Dados\Usuario.xml');
      
      foreach($xml->usuario as $userSearch)
      {
        $userId= ((String)($userSearch->id));
        if ($userId === $idUser){
          $userFound= new User(((String)($userSearch->id)), ((String)($userSearch->username)),
          ((String)($userSearch->email)), ((String)($userSearch->urlImagemPerfil)), ((String)($userSearch->ativo)),
          ((String)($userSearch->instituicaoOrigem)), ((String)($userSearch->titulo)),
          ((String)($userSearch->cpf)), ((String)($userSearch->nome)),((String)($userSearch->banidoSistema)),
          ((String)($userSearch->idComunidadePertence)));
          echo json_encode($userFound);
          break;
        }
      }

      /*$xmlCD= simplexml_load_file( '..\Dados\ComunidadeDiscussao.xml');
      $iterator= 0;
      var $discussoes;
      foreach($xmlCD->comunidadeDiscussao as $cd)
      {
        $comunidadeId= $cd->idComunidade;
        if ($comunidadeId=== '0')
        {

        }
      }*/
    }
  }


?>
