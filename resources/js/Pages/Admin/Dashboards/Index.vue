<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';

</script>

<template>
    <AdminLayout title="Admin dashboard">

        <v-container>

            <v-row justify="center" class="mb-5">
                <v-col cols="12">
                    <v-alert color="success">
                        <v-alert-title>Welcome to Admin dashboard!</v-alert-title>
                    </v-alert>
                </v-col>
            </v-row>

        </v-container>

    </AdminLayout>
</template>
