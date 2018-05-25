<?php


  class User {
    function __construct($id, $username, $email, $picture, $active, $instit, $title, $cpf, $name, $ban, $idLab, $idComuAdm){
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
      $this->idComuAdm= $idComuAdm;
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
          if (hash('sha256', $pass) == $userPass){
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
          ((String)($userSearch->idComunidadePertence)), ((String)($userSearch->idComunidadeAdministra)));
          echo json_encode($userFound);
          break;
        }
      }

    }
  }


?>
