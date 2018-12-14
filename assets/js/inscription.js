var v = new Vue({
  el: '#app',

  data: {
    //Pseudo
    pseudo: 'Arthur',
    pseudoError: false,
    msgPseudoError: false,
    textePseudoError: "Pseudo trop court",
    msgPseudo: false,
    textePseudo: "Veuillez remplir le champs",

    //Mot de passe 
    mdp: 'Arthur00@',
    verifMdp: 'Arthur00@',
    mdpError: false,
    msgMdpError: false,
    texteMdpError: "Veuillez mettre un mot de passe de 8 caractères, avec une minuscule, une majuscule, un chiffre, un symbole",
    msgMdp: false,
    texteMdp: "Veuillez remplir le champs",

    verifCheck: false,
    check: false,
  }
})

$(document).ready(function () {
  $('.ui.checkbox').checkbox();

  $(".btn-envoi").click(function () {
    if (!v.pseudo) {
      v.msgPseudoError = true;
    }

    if (!v.mdp || !v.verifMdp) {
      v.msgMdpError = true;
    }

    if (v.check) {
      if (!v.msgPseudoError && !v.msgMdpError) {
        inscription();
      }
    }
    if (!v.check) {
      v.verifCheck = true;
    }
  });

  $('#checkConnected').change(function () {
    if (v.check) {
      v.verifCheck = false
    }
    else {
      v.verifCheck = true
    }
  });

  $("#pseudo").focusout(function () {
    v.textePseudoError = "Pseudo trop court"
    if (!verifLongueur(v.pseudo, 3, 20)) {
      v.pseudoError = true;
      v.msgPseudoError = true;
    }
    else {
      v.pseudoError = false;
      v.msgPseudoError = false;
    }
  })

  $("#mdp").focusout(function () {
    if (!verifPassword(v.mdp)) {
      v.mdpError = true;
      v.msgMdpError = true;
      v.texteMdpError = "Veuillez mettre un mot de passe de 8 caractères, avec une minuscule, une majuscule, un chiffre, un symbole"
    }
    else {
      v.mdpError = false;
      v.msgMdpError = false;
    }
  })


  $("#verifMdp").focusout(function () {
    if (v.mdp == v.verifMdp) {
      v.mdpError = false;
      v.msgMdpError = false;
    }
    else {
      v.mdpError = true;
      v.msgMdpError = true;
      v.texteMdpError = "Les mots de passe ne sont pas identiques"
    }
  })
})


function inscription_bdd() {
  var content = { pseudo: v.pseudo, mdp: v.mdp }; //object

  return fetch('./api/index.php?controller=inscription', {
    method: 'POST',
    headers: { "Content-type": "application/json" },
    body: JSON.stringify(content)
  })
    .then(res => res.json()) // on récupère le corps au format text.
    .then(res => {
      console.log(res)
      if (res == true) {
        location.href = "page.php"
      }
      if (res == "pseudo_deja_enregistre") {
        v.textePseudoError = "Pseudo déja enregistré"
        v.pseudoError = true
        v.msgPseudoError = true
      }
    });
}

function inscription() {
  var continuer = true;

  if (continuer) {
    inscription_bdd();
    alert("Insertion BDD")
  }
}