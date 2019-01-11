var v = new Vue({
  el: '#app',

  data: {
    //Pseudo
    pseudo: 'Arthur',
    pseudoError: false,
    msgPseudoError: false,
    textePseudoError: 'Pseudo trop court',
    msgPseudo: false,
    textePseudo: 'Veuillez remplir le champs',

    //Mot de passe
    mdp: 'Arthur00@',
    verifMdp: 'Arthur00@',
    mdpError: false,
    msgMdpError: false,
    texteMdpError:
      'Veuillez mettre un mot de passe de 8 caractères, avec une minuscule, une majuscule, un chiffre, un symbole',
    msgMdp: false,
    texteMdp: 'Veuillez remplir le champs',

    verifCheck: false,
    check: false
  },

  methods:{
    checkLabel: function () {
      this.check==true ? this.verifCheck=true : this.verifCheck=false
    }
  }
})

$(document).ready(function() {
  

  $('.btn-envoi').click(function() {
    if(!v.pseudo) v.msgPseudoError = true
    
    if (!v.mdp || !v.verifMdp) v.msgMdpError = true
    
    if (v.check &&  (!v.msgPseudoError && !v.msgMdpError)  )  inscription_bdd()
      
    if (!v.check) v.verifCheck = true
    
  })

  $('#checkConnected').change(function() { (v.check) ? v.verifCheck = false : v.verifCheck = true })


  $('#pseudo').focusout(function() {
    v.textePseudoError = 'Pseudo trop court'
    if (!verifLongueur(v.pseudo, 3, 20)) {
      v.pseudoError = true
      v.msgPseudoError = true
    } else {
      v.pseudoError = false
      v.msgPseudoError = false
    }
  })

  $('#mdp').focusout(function() {
    if (!verifPassword(v.mdp)) {
      v.mdpError = true
      v.msgMdpError = true
      v.texteMdpError =
        'Veuillez mettre un mot de passe de 8 caractères, avec une minuscule, une majuscule, un chiffre, un symbole'
    } else {
      v.mdpError = false
      v.msgMdpError = false
    }
  })

  $('#verifMdp').focusout(function() {
    if (v.mdp == v.verifMdp) {
      v.mdpError = false
      v.msgMdpError = false
    } else {
      v.mdpError = true
      v.msgMdpError = true
      v.texteMdpError = 'Les mots de passe ne sont pas identiques'
    }
  })
})

function inscription_bdd() {
  // Check pseudo / password are not empty

  // Send the login request
  return fetch(`${API_PREFIX}register`, {
    method: 'POST',
    headers: { 'Content-type': 'application/json' },
    body: JSON.stringify({
      pseudo: v.pseudo,
      password: v.mdp
    })
  })
    .then(async res => {
      if (!isValidHttpCode(res)) {
        // The server returned an error, stop the login process
        const { error = 'The server returned an error.' } = await res.json().catch(_ => ({}))
        v.texteMdpError = error
        v.msgMdpError = true
        return Promise.reject(error)
      }
      return res
    })
    .then(res => res.json())
    .then(afterConnect)
    .catch(console.error)
}

function afterConnect(res) {
  if (!res) return
  window.location.href = 'login.html'
}

Vue.config.devtools = true

