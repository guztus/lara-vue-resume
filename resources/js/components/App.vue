<template>
    <NavBar/>
    <router-view />
</template>

<script>
import {defineComponent} from "vue";
import NavBar from "./NavBar.vue";

export default defineComponent({
    components: { NavBar }
})
</script>

<style>

</style>
