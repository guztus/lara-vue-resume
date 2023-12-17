<template>
    <h2>Hello from Vue 3 component</h2>
    <button @click="count++">Count is: {{ count }}</button>
    <p>
        <router-link to="/">Go to Home</router-link>
        <router-link to="/about">Go to About</router-link>
    </p>
    <!-- route outlet -->
    <!-- component matched by the route will render here -->
    <router-view />
</template>

<script setup>
    import { ref } from 'vue';
    const count = ref(0);
</script>

<script>
export default {
    computed: {
    },
    methods: {
    },
}
</script>

<style>

</style>
