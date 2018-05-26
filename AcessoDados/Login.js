$(document).ready(function(){
  $('#btn-login').click(function(){
    var email= $('#email').val();
    var pass= $('#pass').val();
    if ((email!= null)||(pass!= null))
    {
      $.ajax({
        type: 'POST',
        url: 'ControleDados/Login.php',
        contentType: 'application/x-www-form-urlencoded',
        dataType: 'json',
        data: 'function=login&email='+email+'&pass='+pass,
        success: function (result){
			if (result == "") {
				alert("Senha ou e-mail incorretos.")
			} else {
				localStorage.setItem('userId', result);
				window.location.assign('perfil.html');
			}	
        }
		
      });
    }
  });
});
