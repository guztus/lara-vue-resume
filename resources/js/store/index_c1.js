import axios from 'axios'
import { createStore } from 'vuex'
import sharedMutations from 'vuex-shared-mutations'

export default createStore({
    state() {
        return {
            user: null,
            loading: false
        }
    },
    getters: {
        user(state) {
            return state.user
        },
        verified(state) {
            if (state.user) return state.user.email_verified_at
            return null
        },
        id(state) {
            if (state.user) return state.user.id
            return null
        }
    },
    mutations: {
        setUser(state, payload) {
            state.user = payload
        },
        setLoading(state, payload) {
            state.loading = payload
        }
    },
    actions: {
        async login({ dispatch }, payload) {
            await axios.get('/sanctum/csrf-cookie')

            await axios.post('/api/login', payload)
                .then((res) => {
                    if (res.data.access_token) {
                        localStorage.setItem(
                            'access_token',
                            res.data.access_token
                        )
                    }
                    return dispatch('getUser')
                }).catch((err) => {
                    throw err.response
                })
        },
        async register({ dispatch }, payload) {
            await axios.post('/api/register', payload)
                .then(() => {
                    return dispatch('login', {'email': payload.email, 'password': payload.password})
                }).catch((err) => {
                    throw(err.response)
                })
        },
        async logout({ commit }) {
            await axios.post('/api/logout')
                .then(() => {
                    commit('setUser', null)
                }).catch((err) => {
                    throw(err.response)
                })
        },
        async getUser({ commit }) {
            await axios.get('/api/user')
                .then((res) => {
                    commit('setUser', res.data)
                }).catch((err) => {
                    throw err.response
                })
        },
        async profile({commit}, payload) {
            await axios.patch('/api/profile', payload)
                .then((res) => {
                    commit('setUser', res.data.user)
                }).catch((err) => {
                    throw err.response
                })
        },
        async password({commit}, payload) {
            await axios.patch('/api/password', payload)
                .then((res) => {
                }).catch((err) => {
                    throw err.response
                })
        },
        async verifyResend({dispatch}, payload) {
            let res = await axios.post('/api/verify-resend' , payload)
            if (res.status != 200) throw res
            return res
        },
        async verifyEmail({dispatch}, payload){
            let res = await axios.post('/api/verify-email/' + payload.id + '/' + payload.hash)
            if (res.status != 200) throw res
            dispatch('getUser')
                return res
        },
    },
    plugins: [sharedMutations({ predicate: ['setUser', 'setLoading'] })]
})
