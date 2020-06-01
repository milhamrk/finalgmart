const state = {
	all: {},
	currentUser: localStorage.getItem('email')
}

const mutations = {
	SET_USER (state, { user }) {
		state.all = {...state.all, [user.id]: user.data() }
	}
}

const actions = {
	seed ({ rootState }, {emailUser, namaUser, orgUser}) {
		let userRef = rootState.db.collection('users')

		userRef.doc(emailUser).set({
			nama: namaUser,
			org: orgUser
		})
	},

	async get ({ commit, rootState }) {
		let userRef = rootState.db.collection('users')
		let users = await userRef.get()

		users.forEach(user => commit('SET_USER', { user }))
	}
}

export default {
	namespaced: true, 
	state, 
	mutations, 
	actions
}

