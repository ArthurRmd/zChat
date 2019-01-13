var v = new Vue({
  el: '#app',

  data: {
    //Pseudo
    pseudo: '',
    pseudoError: false,
    msgPseudoError: false,
    textePseudoError: 'Pseudo trop court',
    msgPseudo: false,
    textePseudo: 'Veuillez remplir le champs',

    //Mot de passe
    mdp: '',
    verifMdp: '',
    mdpError: false,
    msgMdpError: false,
    texteMdpError:
      'Veuillez mettre un mot de passe de 8 caractères, avec une minuscule, une majuscule, un chiffre, un symbole',
    msgMdp: false,
    texteMdp: 'Veuillez remplir le champs',

    verifCheck: false,
    check: false
  },

  methods: {
    checkLabel: function() {
      this.check == true ? (this.verifCheck = true) : (this.verifCheck = false)
    }
  }
})

$(document).ready(function() {
  $('.btn-envoi').click(function(e) {
    e.preventDefault()
    if (!v.pseudo) v.msgPseudoError = true

    if (!v.mdp || !v.verifMdp) v.msgMdpError = true

    if (v.check && (!v.msgPseudoError && !v.msgMdpError)) inscription_bdd()

    if (!v.check) v.verifCheck = true
  })

  $('#checkConnected').change(function() {
    v.check ? (v.verifCheck = false) : (v.verifCheck = true)
  })

  $('#pseudo').focusout(function() {
    if (!verifLongueur(v.pseudo, 3, 255)) {
      v.textePseudoError = 'Invalid pseudo, 3 chars minimum.'
      v.msgPseudoError = true
      v.pseudoError = true
    } else {
      v.msgPseudoError = false
      v.pseudoError = false
    }
  })

  $('#mdp').focusout(function() {
    if (!verifLongueur(v.mdp, 4, 255)) {
      v.texteMdpError = 'Invalid password, 4 chars minimum.'
      v.msgMdpError = true
      v.mdpError = true
    } else {
      v.msgMdpError = false
      v.mdpError = false
    }
  })

  $('#verifMdp').focusout(function() {
    if (v.mdp == v.verifMdp) {
      v.mdpError = false
      v.msgMdpError = false
    } else {
      v.mdpError = true
      v.msgMdpError = true
      v.texteMdpError = "Passwords don't match."
    }
  })
})

function inscription_bdd() {
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
