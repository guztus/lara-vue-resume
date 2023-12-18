<template>
    <NavBar/>
    <div class="container-xxl my-md-4">
        <router-view />
    </div>
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
