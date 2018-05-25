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
          localStorage.setItem('userId', result);
          window.location.assign('perfil.html');
        }

      });
    }
  });
});
