<template>
    <Menu as="div" class="relative ml-3">
    <div>
        <MenuButton class="flex">
            <span class="sr-only">Open user menu</span>
            <BellIcon class="h-6 w-6" aria-hidden="true" />
            <span class="inline-flex items-center justify-center px-1 py-1 mr-2 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ user.show_notification ? user.active_notification_count : 0 }}</span>
        </MenuButton>
    </div>
    <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
        <MenuItems class="absolute right-0 z-10 mt-2 w-80 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div v-if="user.active_notifications.length > 0 && user.show_notification">
                <MenuItem v-for="notification in user.active_notifications" v-slot="{ active }" @click.prevent="read(notification)">
                    <div :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">
                        <span class="text-xs text-white bg-green-800 inline-block rounded px-2 py-0.5">{{ notification.type }}</span> <span class="text-xs">{{ notification.created_at_friendly }}</span>
                        <br/>
                        <a href="#" >{{ notification.text }}</a>
                    </div>
                </MenuItem>
            </div>
            <div v-else class="block px-4 py-2 text-sm text-gray-700">
                No notification
            </div>
        </MenuItems>
    </transition>
    </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { Inertia } from '@inertiajs/inertia';
import { BellIcon } from '@heroicons/vue/20/solid';

let props = defineProps({
    user: Object
})

// Update read status of notification
function read(value)
{
    Inertia.post(route('impersonate.read', { user: props.user.id, notification: value.pivot.id }));
}

</script>