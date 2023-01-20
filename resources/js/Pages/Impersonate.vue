<template>
  <MainNav class="bg-gray-300 px-10 py-6">
    <template v-slot:right>
        <NotificationDropdown :user="user"/>
    </template>      
  </MainNav>
  <Layout>
    <template v-slot:right_slot>Hello</template>
    <div class="flex items-center justify-between">
        <h1 class="text-5xl font-bold py-3">Welcome, {{ user.name }}!</h1>
    </div>
  </Layout>  
</template>
  
<script setup>
import Layout from "@/Layout/Master.vue";
import MainNav from "@/Components/MainNav.vue";
import NotificationDropdown from "@/Components/NotificationDropdown.vue";

defineProps({
    user: Object,
    errors: Object
})

</script>