function videoPlayer(){
  //criação de variáveis para contorlar os elementos do vídeo que iremos alterar
  var media = document.querySelector('video');
  var controls = document.querySelector('.controls');

  var play = document.querySelector('.play');
  var stop = document.querySelector('.stop');
  var rwd = document.querySelector('.rwd');
  var fwd = document.querySelector('.fwd');

  var timerWrapper = document.querySelector('.timer');
  var timer = document.querySelector('.timer span');
  var timerBar = document.querySelector('.timer div');
  //remoção dos controles default do player HTML para inserção dos customizados
  media.removeAttribute('controls');
  controls.style.visibility = 'visible';
  //event listener para quando apertarem o botão de play, a função playpausemedia executar
  play.addEventListener('click', playPauseMedia);
  //função de play e pause
  function playPauseMedia() {
    //problem fixer
    rwd.classList.remove('active');
    fwd.classList.remove('active');
    clearInterval(intervalRwd);
    clearInterval(intervalFwd);

    if(media.paused) {
      play.setAttribute('data-icon','u');
      media.play();
    } else {
      play.setAttribute('data-icon','P');
      media.pause();
    }
  }
  //event listener para quando o usuário der stop no vídeo e para quando o vídeo acabar
  stop.addEventListener('click', stopMedia);
  media.addEventListener('ended', stopMedia);
  //função stopMedia
  function stopMedia() {
    //problem fixer
    rwd.classList.remove('active');
    fwd.classList.remove('active');
    clearInterval(intervalRwd);
    clearInterval(intervalFwd);

    media.pause();
    media.currentTime = 0;
    play.setAttribute('data-icon','P');
  }
  //event listener para adiantar e voltar o vídeo
  rwd.addEventListener('click', mediaBackward);
  fwd.addEventListener('click', mediaForward);

  //função backw e forw
  var intervalFwd;
  var intervalRwd;

  function mediaBackward() {
    clearInterval(intervalFwd);
    fwd.classList.remove('active');

    if(rwd.classList.contains('active')) {
      rwd.classList.remove('active');
      clearInterval(intervalRwd);
      media.play();
    } else {
      rwd.classList.add('active');
      media.pause();
      intervalRwd = setInterval(windBackward, 200);
    }
  }

  function mediaForward() {
    clearInterval(intervalRwd);
    rwd.classList.remove('active');

    if(fwd.classList.contains('active')) {
      fwd.classList.remove('active');
      clearInterval(intervalFwd);
      media.play();
    } else {
      fwd.classList.add('active');
      media.pause();
      intervalFwd = setInterval(windForward, 200);
    }
  }
  function windBackward() {
    if(media.currentTime <= 3) {
      rwd.classList.remove('active');
      clearInterval(intervalRwd);
      stopMedia();
    } else {
      media.currentTime -= 3;
    }
  }

  function windForward() {
    if(media.currentTime >= media.duration - 3) {
      fwd.classList.remove('active');
      clearInterval(intervalFwd);
      stopMedia();
    } else {
      media.currentTime += 3;
    }
  }

  media.addEventListener('timeupdate', setTime);

  function setTime() {
  var minutes = Math.floor(media.currentTime / 60);
  var seconds = Math.floor(media.currentTime - minutes * 60);
  var minuteValue;
  var secondValue;

  if (minutes < 10) {
    minuteValue = '0' + minutes;
  } else {
    minuteValue = minutes;
  }

  if (seconds < 10) {
    secondValue = '0' + seconds;
  } else {
    secondValue = seconds;
  }

  var mediaTime = minuteValue + ':' + secondValue;
  timer.textContent = mediaTime;

  var barLength = timerWrapper.clientWidth * (media.currentTime/media.duration);
  timerBar.style.width = barLength + 'px';
}
}
