var v = new Vue({
  el: '#app',
  data: {
    estConnecte: false,
    pseudo: ''
  }
})

Vue.config.devtools = true;

$(document).ready(function () {
  $(".btn").click(function () {


    console.log("clique")


    $('.sidebar').sidebar('setting', {
      dimPage             : false,
      closable            : false,
      transition          : 'overlay',
      mobileTransition    : 'overlay'})
    .sidebar('toggle');

    


    if(!$('.detect').hasClass('visible')){
      $( ".test" ).addClass( "espace-gauche" );
      $(".zone-texte").css('width','calc(100vw - 30px - 260px)')
      $(".zone-texte").css('left','270px')
    }
    else{
      $( ".test" ).removeClass( "espace-gauche");
      $(".zone-texte").css('width','calc(100vw - 30px)')
      $(".zone-texte").css('left','10px')
    }


    });

    


})


function ajax() {
  var content = {};

  return fetch('../../api/controllers/connexion.php', {
    method: 'POST',
    headers: { "Content-type": "application/json" },
    body: JSON.stringify(content)
  })
    .then(res => res.json())
    .then(res => {
      console.log(res)
      return res
    });
}
