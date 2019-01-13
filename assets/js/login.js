var v = new Vue({
  el: '#app',

  data: {
    //Pseudo
    pseudo: '',
    pseudoError: false,

    msgPseudoError: false,
    textePseudoError: "L'adresse mail donné n'est pas compatible",
    msgPseudo: false,
    textePseudo: 'Veuillez remplir le champs',

    //Password
    mdp: '',
    mdpError: false,

    msgMdpError: false,
    texteMdpError: '',
    msgMdp: false,
    texteMdp: 'Veuillez remplir le champs'
  }
})
Vue.config.devtools = true

$(document).ready(function() {
  // Check if user is already logged in
  if (checkLoggedIn()) return (window.location.href = 'chat.html')

  $('.btn-envoi').click(function(e) {
    e.preventDefault()

    if (!v.msgPseudoError && !v.msgMdp) connexion_bdd()
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
})

function connexion_bdd() {
  // Check pseudo / password are not empty
  if (!v.pseudo || v.pseudo === '' || !v.mdp || v.mdp === '') return

  // Send the login request
  return fetch(`${API_PREFIX}login`, {
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

// Function called when login worked
function afterConnect(res) {
  if (!res) return

  localStorage.setItem('loggedIn', true)
  localStorage.setItem('user', JSON.stringify(res))
  window.location.href = 'chat.html'
}
