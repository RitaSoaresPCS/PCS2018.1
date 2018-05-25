$(document).ready(function(){
  $('#logout').click(function(){
    localStorage.setItem('userId', '-1');
    window.location.assign('index.html');
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
    }

  });
});
