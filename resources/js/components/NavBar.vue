<template>
    <nav class="shadow-sm navbar navbar-expand-lg navbar-white bg-white">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mt-2 mt-lg-0 mb-lg-0">
                    <li class="nav-item">
                        <router-link to="/resumes" class="nav-link">My Resumes</router-link>
                    </li>
                </ul>
                <ul v-if="store.getters.user" class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item ms-auto">
                        <div class="nav-link cursor-pointer" @click="logout" style="cursor: pointer">Logout</div>
                    </li>
                </ul>
                <ul v-else class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item ms-auto">
                        <router-link to="/login" class="nav-link">Log in</router-link>
                    </li>
                    <li class="nav-item ms-auto">
                        <router-link to="/register" class="nav-link">Register</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
<script setup>
import store from '../store';
import router from '../router';

async function logout() {
    await store.dispatch('logout');
    router.push({name: 'login'})
}
</script>
