<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout title="">

        <Head title="Reset password" />

        <v-row justify="center">
            <v-col cols="12" lg="6">
                <h1 class="text-primary">Reset password</h1>

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

                    <div class="mt-4">
                        <v-text-field
                            v-model="form.password"
                            label="Password"
                            :error-messages="form.errors.password"
                            @click="form.errors.password=null"
                            type="password"
                            required
                            autocomplete="new-password"
                            variant="solo-filled"
                        ></v-text-field>
                    </div>

                    <div class="mt-4">
                        <v-text-field
                            id="password_confirmation"
                            v-model="form.password_confirmation"
                            label="Confirm Password"
                            :error-messages="form.errors.password_confirmation"
                            @click="form.errors.password_confirmation=null"
                            type="password"
                            required
                            autocomplete="new-password"
                            variant="solo-filled"
                        ></v-text-field>
                    </div>

                    <div class="flex items-center justify-lg-space-between mt-4">
                        <v-btn :disabled="form.processing" type="submit" class="mr-2" color="primary">Reset Password</v-btn>
                    </div>

                </form>

            </v-col>
        </v-row>


    </GuestLayout>
</template>
