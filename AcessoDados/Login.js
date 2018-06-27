$(document).ready(function(){
  $('#btn-login').click(function(){
    var email = $('#email').val();
    var pass = $('#pass').val();
    if ((email != null)||(pass != null))
    {
      $.ajax({
        type: 'POST',
        url: 'ControleDados/Login.php',
        contentType: 'application/x-www-form-urlencoded',
        dataType: 'json',
        data: 'func=login&email='+email+'&pass='+pass,
        success: function (result){
			if (result.length == 0) {
				alert("Senha ou e-mail incorretos.")
			} else {
				result = JSON.parse(result);
				localStorage.setItem('userId', result.id);
				localStorage.setItem('isAdminSistema', result.isAdminSistema);
				window.location.assign('perfil.html');
			}	
        }
		
      });
    }
  });
});
