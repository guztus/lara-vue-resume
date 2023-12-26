<template>
    <div
        class="flex items-start border px-4 py-3 rounded relative md:p-2 w-full mx-auto bg-danger border border-danger text-danger"
        role="alert shadow">
        <span v-if="!content.errors" class="block sm:inline w-full text-center text-black">
      {{ content.message }}
    </span>
        <div v-else class="block sm:inline w-full text-center text-black">
            <ul class="text-sm text-left">
                <li v-for="(error, index) in content.errors" :key="index">
                    <ul>
                        <li v-for="(e, eIndex) in error" :key="eIndex">
                            {{ e }}
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <span @click="$emit('close')" class="">
      X
    </span>
    </div>
</template>

<script setup>

defineProps({
    type: {
        type: String,
        default: "",
    },
    content: {
        type: Object,
        default: ""
    }
})
</script>
