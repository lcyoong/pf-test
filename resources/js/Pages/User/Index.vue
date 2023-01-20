<template>
  <MainNav class="bg-gray-300 px-10 py-6"/>
  <Layout>
    <div class="">
      <!--Title and add button-->
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold py-3">Users</h1>
      </div>

      <!--Filter-->
      <div class="sm:flex-auto">
        <input type="email" name="email" v-model="search" id="email" class="block w-full rounded-md border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 px-2" placeholder="Filter by name, email or phone"/>
      </div>

      <!--Table-->
      <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Show notification</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Unread</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="user in users.data" :key="user.email">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ user.name }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.email }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.phone }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.show_notification }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ user.active_notification_count }}</td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 space-x-3">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900" @click="editUser(user)"
                        >Edit<span class="sr-only">, {{ user.name }}</span></a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Pagination-->
    <Pagination :pagination="users"/>
  </Layout>

  <UserEdit ref="editUserModalRef" :user="userToEdit" :errors="errors"/>

</template>

<script setup>
import { ref, watch } from 'vue';
import debounce from "lodash/debounce";
import { Inertia } from '@inertiajs/inertia';
import Layout from "@/Layout/Master.vue";
import MainNav from "@/Components/MainNav.vue";
import Pagination from "@/Components/Pagination.vue";
import UserEdit from "@/Modals/UserEdit.vue";

let props = defineProps({
    users: Object,
    search: String,
    errors: Object
})

let search = ref(props.search)

let userToEdit = ref()

let editUserModalRef = ref()

watch(search, debounce(function (value) {
  Inertia.get('/admin/users', { search: value }, { preserveState: true, replace: true });
}, 300));

function editUser(value)
{
    userToEdit.value = value
    editUserModalRef.value.show()
}
</script>