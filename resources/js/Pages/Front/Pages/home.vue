<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';

defineProps({
});
</script>

<template>
    <GuestLayout title="">

        <v-container>

            <v-row justify="center">
                <v-col cols="12" lg="6">
                    <v-alert color="primary" class="text-center">
                        <h1 class="text-center">Welcome to {{ $page.props.appName }}!</h1>
                        <v-btn color="success" :to="route('quizzes.index')" class="mt-4" >Check out our Quizzes!</v-btn>
                    </v-alert>
                </v-col>
            </v-row>

        </v-container>

    </GuestLayout>
</template>
