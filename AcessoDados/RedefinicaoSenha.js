$(document).ready(function(){
  $('#btn-redefinir-senha').click(function(){
    var email = $('#email').val();
    if (email != null)
    {
      $.ajax({
        type: 'POST',
        url: 'ControleDados/RedefinicaoSenha.php',
        contentType: 'application/x-www-form-urlencoded',
        dataType: 'json',
		data: { func: "redefinirSenha", email: email },
        success: function (result){
			if (result.length == 0) {
				alert("E-mail inexistente.")
			} else {
				alert("Senha redefinida com sucesso. Verifique seu e-mail.")
				window.location.assign('index.html');
			}	
        }
		
      });
    }
  });
});
