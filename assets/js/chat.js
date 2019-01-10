'use strict'

new Vue({
  el: '#app',
  data() {
    return {
      loading: true,
      loadingError: false,

      user: null,
      friends: null,
      chatFriend: null,
      messages: [],
      newMessage: null,
      notif: null,

      autoRefreshMessagesToggle: true,

      addFriend: {
        error: {
          visible: false,
          msg: null
        },
        toAddId: null
      }
    }
  },

  // Function triggered on page load
  async mounted() {
    // Check the user is logged in
    if (!checkLoggedIn()) return (window.location.href = 'login.html')

    // Load current user data from cache
    this.user = JSON.parse(localStorage.getItem('user') || false)

    // Load autoRefreshMessagesToggle from cache
    this.autoRefreshMessagesToggle = JSON.parse(localStorage.getItem('autoRefreshMessages') || true)

    // Fetch all data from the API
    await Promise.all([this.fetchMessages(), this.fetchFriends()])

    // Fetching OK
    this.loading = false

    // Error message "No friend ID was specified."
    if (this.notif && this.notif.msg === 'No friend ID was specified.') {
      // Redirect to first friend in the list
      if (this.friends === null) await this.fetchFriends()
      if (this.friends.length > 0)
        return (window.location.href = `chat.html?friendId=${this.friends[0].id}`)
      // User has 0 friends, show a message.
      this.setNotif('info', 'Start chatting by adding friends using the sidebar menu !')
    }

    // Wait for DOM update (component need to be rendered)
    Vue.nextTick().then(() => {
      // Load the sidebar
      $('.sidebar').sidebar({
        context: '#app',
        dimPage: false,
        closable: false,
        transition: 'overlay',
        mobileTransition: 'overlay'
      })
      // Load the 'refresh messages' toggle button
      $('.ui.checkbox').checkbox()
    })

    // Stop loading screen and scroll to the last message
    this.scrollChat()

    // Start the auto-refresh cycle (it will check if setting is on)
    // Refresh the messages every 3 seconds
    window.setInterval(this.autoRefreshMessages, 3000)
  },

  methods: {
    // Show / Hide the sidebar
    toggleSidebar() {
      $('.sidebar').sidebar('toggle')
      $('#msg-area').css('left', $('.detect').hasClass('visible') ? '10px' : '270px')
    },

    showAddFriendModal() {
      $('.ui.modal#addFriend').modal('show')
    },

    sendFriendRequest() {
      if (this.addFriend.toAddId) {
        //appel au controller
        alert('appel au controller addFriend : ID ->' + this.addFriend.toAddId)
      }
    },

    // Set the notification
    setNotif(type, msg) {
      this.notif = { type, msg }
      console.log('Notif was set :', this.notif)
    },

    // Scroll to the last message
    scrollChat() {
      // Wait for DOM update (component need to be rendered)
      Vue.nextTick().then(() => {
        if (this.loading || this.loadingError || !this.chatFriend) return

        const msgList = document.querySelector('.msg-list')
        msgList.scrollTop = msgList.scrollHeight
      })
    },

    // Auto refresh messages if toggle 'autoRefreshMessagesToggle' is on
    autoRefreshMessages() {
      if (!this.loadingError && this.chatFriend && this.autoRefreshMessagesToggle)
        this.fetchMessages()
    },

    // The "Auto-refresh messages" toggle was clicked, save it in cache
    refreshMessagesToggled(event) {
      localStorage.setItem('autoRefreshMessages', event.srcElement.checked)
    },

    // mutate 'notif' with an error sent by the server
    async setServerError(res) {
      const { error = 'The server returned an error.' } = await res.json().catch(_ => ({}))
      this.notif = { type: 'negative', msg: error }
    },

    // mutate 'notif' with an error sent by the server at page loading
    async setServerLoadingError(res) {
      await this.setServerError(res)
      this.loading = false
      this.loadingError = true
    },

    // Get the messages from the API
    async fetchMessages() {
      if (this.loadingError) return

      const friendId = getQueryString('friendId')
      // Need 'friendId' in URL parameter
      if (!friendId) return this.setNotif('error', 'No friend ID was specified.')

      let res = await fetch(`${API_PREFIX}getMessage&friendId=${friendId}`)

      // The server returned an error
      if (!isValidHttpCode(res)) return this.setServerLoadingError(res)

      res = await res.json()
      if (this.chatFriend !== res.friend) this.chatFriend = res.friend
      if (this.messages !== res.messages) this.messages = res.messages
    },

    // Get the friends from the API
    async fetchFriends() {
      if (this.loadingError) return

      let res = await fetch(`${API_PREFIX}getFriend`)

      // The server returned an error
      if (!isValidHttpCode(res)) return this.setServerLoadingError(res)

      res = await res.json()
      this.friends = res
    },

    // Send the new message
    async sendMessage() {
      // Check the message is not empty
      if (!this.newMessage || this.newMessage.trim() === '') return

      // Send the new message
      const options = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          friendId: this.chatFriend.id,
          content: this.newMessage.trim()
        })
      }
      let res = await fetch(`${API_PREFIX}sendMessage`, options)

      // The server returned an error
      if (!isValidHttpCode(res)) return this.setServerError(res)

      // Refresh the messages list
      await this.fetchMessages()
      this.scrollChat()
      this.newMessage = null
    },

    // Disconnect from the app and the API
    async logout() {
      this.loading = true
      localStorage.clear()
      await fetch(`${API_PREFIX}disconnect`)
      window.location.href = 'login.html'
    }
  }
})

Vue.config.devtools = true
