<script setup>
import { Link } from '@inertiajs/vue3';
import {ref} from "vue";
import Notifications from "@/Components/Notifications.vue";

const props = defineProps({
    title: String,
    titleButtons: String
});

const showMainMenu = ref(null);

function menuListGroupCurrent(){
    if (route().current('admin.quizzes.*'))
        return 'quizzes';

    if (route().current('admin.clients-quizzes.*'))
        return 'clients-quizzes';

    return null
}

const menuListGroupOpen = ref([menuListGroupCurrent()]);

</script>

<template>
    <v-app class="rounded rounded-md admin-layout">

        <v-app-bar class="text-primary font-weight-bold">
            <v-toolbar-title>
                <Link :href="route('home')" class="text-decoration-none">
                    {{ $page.props.appName }}
                </Link>
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <v-toolbar-items>
               <v-btn color="primary" @click.stop="showMainMenu = !showMainMenu" icon="mdi-menu" rounded="xl"  class="px-4"></v-btn>

            </v-toolbar-items>

        </v-app-bar>


        <v-navigation-drawer v-model="showMainMenu" temporary class="bg-deep-purple" theme="dark">

            <v-list density="compact" nav v-model:opened="menuListGroupOpen">

                <v-list-item :to="route('admin.dashboard')" prepend-icon="mdi-view-dashboard" :active="route().current('admin.dashboard')" title="Dashboard" value="dashboard"></v-list-item>

                <v-list-item :to="route('admin.quizzes.index')" prepend-icon="mdi-help-circle-outline" :active="route().current('admin.quizzes.*')" title="Quizzes" value="quizzes"></v-list-item>

                <v-list-item :to="route('admin.clients-quizzes.index')" prepend-icon="mdi-account-group" :active="route().current('admin.clients-quizzes.*')" title="Clients Quizzes" value="clients-quizzes"></v-list-item>

                <v-list-item :to="route('logout')" prepend-icon="mdi-logout" title="Log out" value="logout"></v-list-item>

            </v-list>
        </v-navigation-drawer>

        <v-app-bar v-if="title" height="48" flat color="deep-purple" theme="dark" class="pa-3">
            <v-toolbar-items class="d-flex w-100 justify-space-between align-center">
                <h2>{{ title }}</h2>

                <div>
                    <slot name="titleButtons"></slot>
                </div>
            </v-toolbar-items>

        </v-app-bar>


        <v-main class="d-flex align-center justify-center" style="min-height: 300px;">
            <v-container fluid class="mt-5">
                <notifications></notifications>
                <slot></slot>
            </v-container>
        </v-main>

        <v-footer class="d-flex justify-center">
            &copy; BillWebStudio 2024
        </v-footer>
    </v-app>
</template>
