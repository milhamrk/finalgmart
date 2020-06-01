<template>
	<div>
		<Message 
			v-for="message in conv.messages" 
			:message="message" 
			:key="message.created" 
		/>
	</div>
</template>
<script>
  import { mapState } from 'vuex'
  import Message from '../components/Message.vue'

  export default {
    name: 'ConversationContainer',

		data () {
			return {
			}
		},

		props: {
			conv: {
				type: Object,
				required: true
			}
		},
		components: {
			Message
		},
		computed:{
			
		}
	}
</script>