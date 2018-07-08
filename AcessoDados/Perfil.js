$(document).ready(function(){
  var userInfo = null;
  $('#logout').click(function(){
	  var confirmou = confirm("Deseja realmente sair?");
	  if (confirmou) { // Usuário confirmou que deseja sair.
		localStorage.setItem('userId', '-1');
		$.post(
			'ControleDados/Logout.php',
			{ func: "logout" }
			, function() {
				window.location.assign('index.html');
			}
		);
	  }
  });

  $.ajax({
    type: 'POST',
    url: 'ControleDados/Login.php',
    contentType: 'application/x-www-form-urlencoded',
    dataType: 'json',
    data: 'func=getData&userId='+localStorage.getItem('userId'),
    success: function (User) {
		var dadosUsuario = JSON.parse(User[0]);
		var divUserPicture = $('#user-picture');
		var divUserName = $('#user-name');
		$('<p />')
			.text(dadosUsuario.username)
			.appendTo(divUserName);
		$('<img />')
			.attr('src', dadosUsuario.urlImagemPerfil)
			.attr('alt', 'Profile picture')
			.appendTo(divUserPicture);
		userInfo = dadosUsuario;
    }
  });
  $.ajax({
    type: 'POST',
    url: 'ControleDados/Discussao.php',
    contentType: 'application/x-www-form-urlencoded',
    dataType: 'json',
    data: 'func=exibirDiscussoesGlobal',
    success: function (discussoes) {
		var dadosDiscussoes = JSON.parse(discussoes);
		var divDiscussoes = $('#discussoes');
		discussoesSize = dadosDiscussoes.length;
		  for (var iterator = 0; iterator< discussoesSize; iterator++){
			var divDiscussao = $('<div />');
			$('<p />')
			  .text(dadosDiscussoes[iterator].titulo)
			  .appendTo(divDiscussao);
			$('<p />')
			  .text('Criado em: '+ dadosDiscussoes[iterator].dataCriacao.substring(0, 10))
			  .appendTo(divDiscussao);
			$('<hr>').appendTo(divDiscussao);
			divDiscussao.appendTo(divDiscussoes);
		  }

    }
  });


});
