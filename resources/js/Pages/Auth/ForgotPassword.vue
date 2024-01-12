<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout title="">
        <Head title="Forgot password" />

        <v-row justify="center">
            <v-col cols="12" lg="6">
                <h1 class="text-primary">Forgot password</h1>

                <div v-if="status" class="mb-4 text-green">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">

                    <div class="mt-4">
                        <v-text-field
                            v-model="form.email"
                            label="Email"
                            :error-messages="form.errors.email"
                            @click="form.errors.email=null"
                            required
                            autofocus
                            autocomplete="username"
                            variant="solo-filled"

                        ></v-text-field>
                    </div>

                    <div class="flex items-center justify-lg-space-between mt-4">
                        <v-btn :disabled="form.processing" type="submit" class="mr-2" color="primary">Email password reset link</v-btn>
                        <v-btn :to="route('login')" flat>Log in</v-btn>
                    </div>

                </form>

            </v-col>
        </v-row>


    </GuestLayout>
</template>
