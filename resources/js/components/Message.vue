<template>
	<li :class="getWhoFirst">
	    <div :class="getWhoSecond">
	        <div :class="getWhoThrid">  {{message.text}}
	            <div class="msg-per-detail text-right">
	                <span class="msg-time txt-light">{{ itulah }}</span>
	            </div>
	        </div>
	        <div class="clearfix"></div>
	    </div>  
	</li>
</template>

<script>
  export default {
    name: 'Message',

		props: {
			message: {
				type: Object,
				required: true
			}
		},

		created () {
			
		},

		computed: {
			getWhoFirst() {
				if (this.message.sender === this.$store.state.users.currentUser) {
					return 'self'
				} else {
					return 'friend'
				}
			},

			getWhoSecond() {
				if (this.message.sender === this.$store.state.users.currentUser) {
					return 'self-msg-wrap'
				} else {
					return 'friend-msg-wrap'
				}
			},

			getWhoThrid() {
				if (this.message.sender === this.$store.state.users.currentUser) {
					return 'msg block pull-right'
				} else {
					return 'msg pull-left'
				}
			},
			itulah(){
				const d = new Date(this.message.created);
				var h = d.getHours();
				var m = d.getMinutes();
				return h + ":" + m;
			}
		}
  }
</script>

