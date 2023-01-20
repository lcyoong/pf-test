<template>
  <div class="max-w-8xl mx-auto px-2 sm:px-6 lg:px-8 min-h-full bg-white py-6">
    <slot></slot>
  </div>
  <Footer/>
</template>

<script setup>
import Footer from '@/Components/Footer.vue';
</script>