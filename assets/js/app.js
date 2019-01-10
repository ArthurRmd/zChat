function verifMail(chaine) {
  var regMail = new RegExp(/^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$/, 'i')
  return regMail.test(chaine.trim())
}

function verifLongueur(chaine, longueurMini, longueurMax) {
  if (chaine.trim().length >= longueurMini && chaine.trim().length <= longueurMax) {
    return true
  } else {
    return false
  }
}

const API_PREFIX = 'api/?controller='

const checkLoggedIn = () => {
  if (localStorage.getItem('loggedIn') === 'true') {
    const user = JSON.parse(localStorage.getItem('user') || {})
    if (typeof user === 'object' && user.hasOwnProperty('id')) {
      return true
    }
  }
  localStorage.clear()
  return false
}

const getQueryString = key => new URLSearchParams(window.location.search).get(key)

const isValidHttpCode = fetchObj =>
  fetchObj.status && fetchObj.status >= 200 && fetchObj.status <= 299
