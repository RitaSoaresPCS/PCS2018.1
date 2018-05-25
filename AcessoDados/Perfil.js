$(document).ready(function(){
  var userInfo= null;
  $('#logout').click(function(){
	  var confirmou = confirm("Deseja realmente sair?");
	  if (confirmou) { // Usuário confirmou que deseja sair.
		localStorage.setItem('userId', '-1');
		window.location.assign('index.html');
	  } 
  });

  $.ajax({
    type: 'POST',
    url: 'ControleDados/Login.php',
    contentType: 'application/x-www-form-urlencoded',
    dataType: 'json',
    data: 'function=getData&userId='+localStorage.getItem('userId'),
    success: function (User){
      var divUserPicture= $('#user-picture');
      var divUserName= $('#user-name');
      $('<p />')
        .text(User.name)
        .appendTo(divUserName);
      $('<img />')
        .attr('src', User.picture)
        .attr('alt', 'Profile picture')
        .appendTo(divUserPicture);
      userInfo= User;
    }
  });
  $.ajax({
    type: 'POST',
    url: 'ControleDados/ComunidadeGeral.php',
    contentType: 'application/x-www-form-urlencoded',
    dataType: 'json',
    data: 'function=exibirDiscussoesGlobal',
    success: function (discussoes){
      var divDiscussoes= $('#discussoes');
      discussoesSize= discussoes.length;
      for (var iterator= 0; iterator< discussoesSize; iterator++){
        var divDiscussao= $('<div />');
        $('<p />')
          .text(discussoes[iterator].title)
          .appendTo(divDiscussao);
        $('<p />')
          .text('Criado em: '+discussoes[iterator].creatnDate)
          .appendTo(divDiscussao);
        $('<hr>').appendTo(divDiscussao);
        divDiscussao.appendTo(divDiscussoes);
      }

    }
  });


});
