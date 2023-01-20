<template>
  <Modal ref="modalRef">
    <p class="text-xl font-bold">New Notification</p>
    <div class="py-5">
      <form class="py-2 space-y-2" @submit.prevent="createNotification">
        <div class="flex flex-col space-y-1">
          <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Type</label>
          <Multiselect
            v-model="form.type"
            :options="types"
          />
        </div>
        <div class="flex flex-col space-y-1">
          <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Text</label>
          <input type="text" v-model="form.text" class="border block w-full min-w-0 flex-1 rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2 px-3 sm:text-sm" />
        </div>
        <div class="flex flex-col space-y-1">
          <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Expire At</label>
          <DatePicker v-model="form.expire_at"/>
        </div>
        <div class="flex flex-col space-y-1">
          <label class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Send To</label>
          <Multiselect
            v-model="form.send_to"
            mode="tags"
            :searchable="true"
            :options="users"
          />          
        </div>        
        <button type="submit" class="flex-none justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Create</button>
      </form>
    </div>
  </Modal>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from "@inertiajs/inertia";
import Modal from "@/Components/Modal.vue";
import { DatePicker } from 'v-calendar';
import 'v-calendar/dist/style.css';
import '@vueform/multiselect/themes/default.css';
import Multiselect from '@vueform/multiselect'

let props = defineProps({
  errors: Object,
  users: Object,
  types: Object
})

const modalRef = ref()

const form = useForm({
  type: '',
  text: '',
  expire_at: '',
  send_to: [],
})

let options = ref(props.users)

const emit = defineEmits()

const show = () => {
  modalRef.value.show()
}

let typeOptions = ref(props.types)

function createNotification() {
  Inertia.post(route("notification.store"), form, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: page => {          
          emit('notificationCreated')
          modalRef.value.close()
        }
      }); 
}

// onMounted(() => {
//   axios.get(route("users.index"))
//   .then((result) => {
//     console.log(result)
//   })
// })

defineExpose({
    show
})
</script>