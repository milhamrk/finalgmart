<template>
	<a v-if="getMsg" :href="'/chat/' + id">
        <div class="chat-data">
            <img class="user-img img-circle"  src="/dist/img/user.png" alt="user"/>
            <div class="user-data">
                 <span class="name block capitalize-font">{{ userName }}</span>
                <span class="time block truncate txt-grey">{{ userOrg }}</span>
                
            </div>
            <div class="clearfix"></div>
        </div>
    </a>
</template>

<script>
  import { mapState } from 'vuex'

  export default {
    name: 'ConversationContainer',

		data () {
			return {
				newMessageText: '',
				userName: '',
				userOrg: ''
			}
		},

		props: {
			conversation: {
				type: Object,
				required: true
			},
			id: {
				type: String,
				required: true
			}
		},

		computed: {
			...mapState({
				usersData: state => state.users.all
			}),
			getMsg () {
				if(this.conversation.users[0] == this.$store.state.users.currentUser){
					this.userName = this.usersData[this.conversation.users[1]].nama
					this.userOrg = this.usersData[this.conversation.users[1]].org
					return true
				}
				else if(this.conversation.users[1] == this.$store.state.users.currentUser){
					this.userName = this.usersData[this.conversation.users[0]].nama
					this.userOrg = this.usersData[this.conversation.users[0]].org
					return true
				}
				else{
					return false
				}
			}
		},

		created () {
			this.$store.state.db.collection('conversations').doc(this.id).onSnapshot(convo => {
				let source = convo.metadata.hasPendingWrites ? 'Local' : 'Server'

				if (convo && convo.data()) {
					convo.data().messages.forEach(message => this.$store.commit('conversations/ADD_MESSAGE', { 
							conversationId: this.id, message })
					)
				}
			})
		},

		methods: {
			send () {
				this.$store.dispatch('conversations/sendMessage', { 
					text: this.newMessageText, 
					created: Date.now(),
					conversationId: this.id,
					sender: this.$store.state.users.currentUser
				})	
			}
		},

		components: {
			// Message,
		}
  }
</script>

<style scoped>
</style>
