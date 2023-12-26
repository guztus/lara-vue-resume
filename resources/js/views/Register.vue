<template>
    <div class="container pt-4">
        <div class="d-flex justify-content-center">
            <div class="flex-1">
                <div class="border w-auto rounded shadow">
                    <div class="p-4 bg-white rounded-2">
                        <form @submit.prevent="register" class="md:w-10/12 md:p-4 w-full mx-auto">
                            <h2 class="text-center mb-4">Register</h2>
                            <div class="form-floating mb-3">
                                <input
                                    id="name"
                                    class="form-control"
                                    :class="{ 'is-invalid': v$.name.$errors.length > 0 }"
                                    v-model="name"
                                    type="text"
                                    autocomplete="name"
                                    name="name"
                                    placeholder=""
                                >
                                <label for="educationDirection">Name</label>
                                <span v-for="error in v$.name.$errors" :key="error.$uid" class="text-danger fst-italic">
                                    {{ error.$message }}
                                </span>
                            </div>

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
                                    autocomplete="new-password"
                                    name="password"
                                    placeholder=""
                                >
                                <label for="educationDirection">Password</label>
                                <span v-for="error in v$.password.$errors" :key="error.$uid" class="text-danger fst-italic">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="form-floating mb-3">
                                <input
                                    id="passwordConfirmation"
                                    class="form-control"
                                    :class="{ 'is-invalid': v$.passwordConfirmation.$errors.length > 0 }"
                                    v-model="passwordConfirmation"
                                    type="password"
                                    autocomplete="new-confirmation"
                                    name="passwordConfirmation"
                                    placeholder=""
                                >
                                <label for="educationDirection">Confirm Password</label>
                                <span v-for="error in v$.passwordConfirmation.$errors" :key="error.$uid" class="text-danger fst-italic">
                                    {{ error.$message }}
                                </span>
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary px-3 py-2 rounded">{{ 'Register' }}</button>
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
const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')

const rules = {
    name: {required},
    email: {required, validate_email},
    password: {required},
    passwordConfirmation: {required}
}

const v$ = useVuelidate(rules, {name, email, password, passwordConfirmation})

async function register() {
    let result = await v$.value.$validate()

    if (result) {
        await store.dispatch('register', {
            'name': name.value,
            'email': email.value,
            'password': password.value,
            'password_confirmation': passwordConfirmation.value,
        }).then(() => {
            successMessage.show('Registration successful!\n You have been logged in.')
            router.push({name: 'home'})
        }).catch((err) => {
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
