'use strict'

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
      loadingError: false,

      user: null,
      friends: [],
      chatFriend: null,
      messages: [],
      notif: null
    }
  },
  async mounted() {
    // Check the user is logged in
    if (!checkLoggedIn()) return (window.location.href = 'connexion.html')

    // Load current user data from cache
    this.user = localStorage.getItem('user')

    await Promise.all([this.fetchMessages(), this.fetchFriends()])
    this.loading = false
  },
  methods: {
    // Set the notification
    setNotif(type, message) {
      this.notif = { type, message }
      console.log('Notif was set :', { type, message })
    },

    async getError(res) {
      this.loading = false
      this.loadingError = true
      const { error = 'The server returned an error.' } = await res.json().catch(e => ({}))
      return { type: 'negative', error }
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

      // The server returned an error
      if (!isValidHttpCode(res)) return this.getError(res)

      res = await res.json()
      this.chatFriend = res.friend
      this.messages = res.messages
      this.loading = false
    },

    // Get the friends from the API
    async fetchFriends() {
      let res = await fetch(`${API_PREFIX}getFriend`)

      // The server returned an error
      if (!isValidHttpCode(res)) return this.getError(res)

      res = await res.json()
      console.log(res)
      // this.friends = await res.json()
      this.friends.forEach(friend => {
        $('#sidebarContent').append(
          `<a class="item" href="chat.html?friendId=${friend.id}">${friend.pseudo}</a>`
        )
      })
    }
  }
})

Vue.config.devtools = true
