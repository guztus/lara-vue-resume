<template>
    <div class="container pt-4">
        <div class="d-flex justify-content-center">
            <div class="flex-1">
                <div class="border w-auto rounded shadow">
                    <div class="p-4 bg-white rounded-2">
                        <form class="md:w-10/12 md:p-4 w-full mx-auto" @submit.prevent="login">
                            <h2 class="text-center mb-4">Log in</h2>
                            <div class="form-floating mb-3">
                                <input
                                    id="email"
                                    class="form-control"
                                    :class="{ 'is-invalid': v$.email.$errors.length > 0 }"
                                    v-model="email"
                                    type="email"
                                    autocomplete="email"
                                    name="email"
                                    placeholder=""
                                >
                                <label for="educationDirection">Email</label>
                                <span v-for="error in v$.email.$errors" :key="error.$uid" class="text-danger fst-italic">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="form-floating mb-3">
                                <input
                                    id="password"
                                    class="form-control"
                                    :class="{ 'is-invalid': v$.password.$errors.length > 0 }"
                                    v-model="password"
                                    type="password"
                                    autocomplete="current-password"
                                    name="password"
                                    placeholder=""
                                >
                                <label for="educationDirection">Password</label>
                                <span v-for="error in v$.password.$errors" :key="error.$uid" class="text-danger fst-italic">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="w-full my-1 py-2 sm:flex sm:items-center sm:justify-end">
                                <div class="sm:w-8/12 w-full flex flex-wrap justify-between items-center mt-3 sm:mt-0">
                                    <div v-if="loading"
                                         class="flex justify-center items-center p-2 px-6 rounded text-white bg-primary hover:bg-primary-dark">
                                        <!--<circle-svg class="w-4 h-4"/>-->
                                    </div>
                                    <button v-else type="submit" class="btn btn-primary px-3 py-2 rounded">{{
                                            'Login'
                                        }}
                                    </button>
                                    <div class="text-right w-full sm:w-auto">
                                        <div class="mt-2 sm:mt-0">
                                            <router-link :to="{ name: 'register' }"
                                                         class="text-sm text-primary hover:underline">
                                                {{ 'New member? Sign up here' }}
                                            </router-link>
                                        </div>
                                        <div class="mt-2 sm:mt-0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useStore} from 'vuex'
import router from '../router'
import {ref} from "vue"
import {createToaster} from "@meforma/vue-toaster";
import vuelidate, {useVuelidate} from '@vuelidate/core'
import {required, email as validate_email} from '@vuelidate/validators'

const successMessage = createToaster({ type: 'success', position: 'top' })
const errorMessage = createToaster({ type: 'error', position: 'top' })

const store = useStore()
const loading = ref(false)
const email = ref('')
const password = ref('')

const rules = {
    email: {required, validate_email},
    password: {required}
}

const v$ = useVuelidate(rules, {email, password})

async function login() {
    let result = await v$.value.$validate()

    if (result) {
        await store.dispatch('login', {'email': email.value, 'password': password.value})
            .then(() => {
                successMessage.show('Login successful!')
                router.push('/resumes')
            })
            .catch((err) => {
                if (err.response.data.errors) {
                    for (const property in err.response.data.errors) {
                        err.response.data.errors[property].forEach((error) => {
                            errorMessage.show(error)
                        })
                    }
                } else if (err.response.data.message) {
                    errorMessage.show(err.response.data.message)
                }
            })
    }
}
</script>
