<template>
    <div class="flex justify-between my-4 items-center">
      <div class="text-sm">
        Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} records
      </div>
      <div>
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
            <Link v-for="(link, index) in pagination.links" :href="link.url" :aria-current="link.active" class="relative z-10 inline-flex items-center border px-4 py-2 text-sm font-medium focus:z-20" :class="{'border-indigo-500 bg-indigo-50 text-indigo-600': link.active, 'rounded-l-md': index == 0, 'rounded-r-md': index == pagination.links.length - 1}">{{ link.label }}</Link>
        </nav>
      </div> 
    </div>   
</template>

<script setup>
defineProps({
    pagination: Object
})

</script>