'use strict'

const API_PREFIX = 'api/?controller='

const checkLoggedIn = () => localStorage.getItem('loggedIn') == 'true'
const getQueryString = key => new URLSearchParams(window.location.search).get(key)

const isValidHttpCode = fetchObj =>
  fetchObj.status && fetchObj.status >= 200 && fetchObj.status <= 299

new Vue({
  el: '#app',
  data() {
    return {
      loading: true,
      user: null,
      friend: null,
      messages: [],
      notif: null
    }
  },
  mounted() {
    // Check the user is logged in
    if (!checkLoggedIn()) return (window.location.href = 'connexion.html')

    // Load current user data from cache
    this.user = localStorage.getItem('user')

    this.fetchMessages()
  },
  methods: {
    // Set the notification
    setNotif(type, message) {
      this.notif = { type, message }
      console.log('Notif was set :', { type, message })
    },

    // Get the messages from the API
    async fetchMessages() {
      const friendId = getQueryString('friendId')
      if (!friendId) {
        // Need 'friendId' in URL parameter
        this.loading = false
        return this.setNotif('error', 'No friend ID was specified.')
      }

      let res = await fetch(`${API_PREFIX}getMessage&friendId=${friendId}`)
      if (!isValidHttpCode(res)) {
        // The server returned an error
        this.loading = false
        const { error = 'The server returned an error.' } = await res.json().catch(e => ({}))
        return this.setNotif('error', error)
      }
      res = await res.json()
      this.friend = res.friend
      this.messages = res.messages
      this.loading = false
    }
  }
})

Vue.config.devtools = true

$(document).ready(function() {
  $('.btn').click(function() {
    console.log('clique')

    $('.sidebar')
      .sidebar('setting', {
        dimPage: false,
        closable: false,
        transition: 'overlay',
        mobileTransition: 'overlay'
      })
      .sidebar('toggle')

    if (!$('.detect').hasClass('visible')) {
      $('.test').addClass('espace-gauche')
      $('.zone-texte').css('width', 'calc(100vw - 30px - 260px)')
      $('.zone-texte').css('left', '270px')
    } else {
      $('.test').removeClass('espace-gauche')
      $('.zone-texte').css('width', 'calc(100vw - 30px)')
      $('.zone-texte').css('left', '10px')
    }
  })
})

function ajax() {
  var content = {}

  return fetch('../../api/controllers/connexion.php', {
    method: 'POST',
    headers: { 'Content-type': 'application/json' },
    body: JSON.stringify(content)
  })
    .then(res => res.json())
    .then(res => {
      console.log(res)
      return res
    })
}
