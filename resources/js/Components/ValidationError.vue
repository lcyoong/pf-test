<script setup>
defineProps({
    error: String
})
</script>

<template>
    <div class="text-red-500 text-sm" v-if="error">{{ error }}</div>
</template>