<template>
  <MainNav class="bg-gray-300 px-10 py-6"/>
  <Layout>
    <div class="">
      <!--Title and add button-->
      <div class="flex items-center justify-between">
        <h1 class="text-xl font-bold py-3">Notifications</h1>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
          <button 
            type="button" 
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
            @click.prevent="newNotificationModalRef.show()">New notification</button>
        </div>        
      </div>

      <!--Filter-->
      <div class="sm:flex-auto">
        <input type="email" name="email" v-model="search" id="email" class="block w-full rounded-md border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 px-2" placeholder="Filter by type and text"/>
      </div>

      <!--Table-->
      <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Type</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Text</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Expired At</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Send To</th>
                    <!-- <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                      <span class="sr-only">Edit</span>
                    </th> -->
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="notification in notifications.data" :key="notification.email">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ notification.type }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ notification.text }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ notification.expire_at }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 space-x-1">
                      <span class="bg-green-600 text-white text-xs rounded px-2 py-0.5" v-for="user in notification.send_to">{{ users[user] }}</span>
                    </td>
                    <!-- <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900" @click="editnotification(notification)"
                        >Edit<span class="sr-only">, {{ notification.name }}</span></a
                      >
                    </td> -->
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Pagination-->
    <Pagination :pagination="notifications"/>
  </Layout>
  <NotificationNew ref="newNotificationModalRef" :users="users" :types="types"/>
</template>

<script setup>
import { ref, watch } from 'vue';
import debounce from "lodash/debounce";
import { Inertia } from '@inertiajs/inertia';
import Layout from "@/Layout/Master.vue";
import MainNav from "@/Components/MainNav.vue";
import Pagination from "@/Components/Pagination.vue";
import NotificationNew from "@/Modals/NotificationNew.vue";

let props = defineProps({
    notifications: Object,
    users: Object,
    search: String,
    errors: Object,
    types: Object
})

let search = ref(props.search)

let newNotificationModalRef = ref()

watch(search, debounce(function (value) {
  Inertia.get('/admin/notifications', { search: value }, { preserveState: true, replace: true });
}, 300));
</script>