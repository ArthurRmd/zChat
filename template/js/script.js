var contenu_chat = [];

$(document).ready(function(){
  getChatMessages()
  window.setInterval(getChatMessages, 1000);
    
  $('#message').keypress(function(e){
      if(e.keyCode == 13)
      envoyer(); 
  });

  $(".btn-envoyer").click(function() {
    envoyer();
  });
     
  $(".btn-clear").click(function() {
    getChatMessages();
    init_input()
  });
})


function getChatMessages() {
  fetch('php/lecture_message.php')
    .then(res => res.json()) // on récupère le corps au format text.
    .then(res => {
      if (JSON.stringify(contenu_chat) !== JSON.stringify(res)){
        effacer_message();
        contenu_chat = res
         //alert(res);

        for (var key in res) {
          $('.texte-message').append("<p class=\"pseudo-font\"> " + res[key].pseudo + " </p> : <p class=\"message-font\">");
          $('.texte-message').append(res[key].message + " <br>");
        }
        scrollChat();

        console.log('Chat rafraichi : Nouveaux messages.')
      }
      else 
        console.log('Chat rafraichi : Pas de nouveaux messages.')
    })
    .catch(err => reject(err));
}

function insertion_message(content) {
  return new Promise (function (resolve, reject){
    fetch('php/insertion_message.php', {
        method: 'POST',
        headers: {
          "Content-type": "application/json"
        },
        body: JSON.stringify(content) // Transforme l'objet en Json 
      })
      .then(res => res.json()) // on récupère le corps au format text.
      .then(res => {
        console.log(res)
        resolve(res)
      })
      .catch(function(err){
        console.log("Erreur insertion" , err)
      });
    })
}

function effacer_message() {
  $('.texte-message').empty();
}

function init_input (){
  $('#message').val('');
  $('#message').focus();
}

function envoyer (){
  var pseudo = document.getElementById("pseudo").value
  var message = document.getElementById("message").value

  if (pseudo && message) {
    var content = {pseudo: pseudo, message: message}; //object
    insertion_message(content)
    .then( function ( res) {
      if (res === true){
        getChatMessages() 
        init_input()
      }
    })    
  }
}

function scrollChat () {
  var ele = document.getElementById('chat')
  ele.scrollTop = ele.scrollHeight
}

  /*
  //Json to Object
  var json = '{"result":true, "count":42}';
  obj = JSON.parse(json);

  var obj = { name: "John", age: 30, city: "New York" };
  var myJSON = JSON.stringify(obj);
  */




// function envoyer(pseudo, message){
//   this.pseudo = pseudo;
//   this.message = message;
// }

// var obj = 
// {
//   1: "",
//   2: ""
// }
// var obj2 = new envoyer (pseudo, message);
// console.log(obj2)
