<template>
    <h2>Welcome</h2>
    <Resume/>
</template>

<script setup>
import { ref } from 'vue';
import Resume from '../components/Resume.vue'

const count = ref(0);
</script>
