<template>
  <div class="max-w-8xl mx-auto px-2 sm:px-6 lg:px-8 flex space-x-4 bg-gray-300 justify-between items-center">
    <nav class="flex items-center space-x-4">
      <div class="text-5xl font-bold">Pf</div>
      <Link :href="route('users.index')"><div class="bg-red-700 text-white px-4 py-2 rounded font-semibold hover:bg-red-600">Users</div></Link>
    </nav>
    <slot name="right"></slot>
  </div>
</template>

<script setup>

</script>