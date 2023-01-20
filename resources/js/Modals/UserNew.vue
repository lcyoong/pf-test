<template>
  <Modal ref="modalRef" @close="localErrors = null">
    <p class="text-xl font-bold">New User</p>
    <div class="py-5">
      <form class="py-2 space-y-2" @submit.prevent="createUser">
        <div class="flex flex-col space-y-1">
          <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Name</label>
          <input type="text" v-model="form.name" class="border block w-full min-w-0 flex-1 rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 sm:text-sm" />
          <ValidationError :error="localErrors?.newUser?.name"/>
        </div>
        <div class="flex flex-col space-y-1">
          <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Phone</label>
          <input type="text" v-model="form.phone" class="border block w-full min-w-0 flex-1 rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 sm:text-sm" />
          <ValidationError :error="localErrors?.newUser?.phone"/>
        </div>
        <div class="flex flex-col space-y-1">
          <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Email</label>
          <input type="text" v-model="form.email" class="border block w-full min-w-0 flex-1 rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 sm:text-sm" />
          <ValidationError :error="localErrors?.newUser?.email"/>
        </div>
        <div class="flex flex-col space-y-1">
          <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Show Notifications</label>
          <Toggle 
            :switch="!!form.show_notification" 
            @toggleOn="form.show_notification = 1"
            @toggleOff="form.show_notification = 0"
          />
        </div>
        <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create</button>
      </form>
    </div>
  </Modal>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import Modal from "@/Components/Modal.vue";
import Toggle from '@/Components/Toggle.vue';

let props = defineProps({
  errors: Object
})

const modalRef = ref()

let localErrors = ref(props.errors)

const form = useForm({
  name: '',
  phone: '',
  email: '',
  show_notification: 1,
})

const emit = defineEmits()

const show = () => {
  modalRef.value.show()
}

// Post new user to database
function createUser() {
  Inertia.post(route("user.store"), form, {
    errorBag: 'newUser',
    preserveState: true,
    preserveScroll: true,
    onSuccess: page => {
      form.reset()
      localErrors.value = null
      emit('userUpdated')
      modalRef.value.close()
    }
  }); 
}

watch(() => props.errors, value => {
  localErrors.value = value
})

defineExpose({
    show
})
</script>