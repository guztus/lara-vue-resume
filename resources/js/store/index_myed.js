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
        id(state) {
            if (state.user) return state.user.id
            return null
        }
    },
    mutations: {
        setUser(state, payload) {
            if (payload) {
                localStorage.setItem(
                    'access_token',
                    payload
                )
                axios.defaults.headers.common['Authorization'] = "Bearer " + localStorage.getItem('access_token');
            } else {
                localStorage.removeItem(
                    'access_token'
                )
                axios.defaults.headers.common['Authorization'] = '';
            }
            state.user = payload
        },
        setLoading(state, payload) {
            state.loading = payload
        }
    },
    actions: {
        async login({ commit, dispatch }, payload) {
            await axios.get('/sanctum/csrf-cookie')

            await axios.post('/api/login', payload)
                .then((res) => {
                    if (res.data.access_token) {
                        commit('setUser', res.data.access_token)
                    }
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
        async password({ commit }, payload) {
            await axios.patch('/api/password', payload)
                .then((res) => {
                }).catch((err) => {
                    throw err.response
                })
        },
    },
    plugins: [sharedMutations({ predicate: ['setUser', 'setLoading'] })]
})
