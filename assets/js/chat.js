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
    $('.sidebar')
      .sidebar('setting', 'transition', 'overlay')
      .sidebar('toggle');
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
