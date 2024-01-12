<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});


const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout title="">

        <Head title="Log in" />

        <v-row justify="center">
            <v-col cols="12" lg="6">
                <h1 class="text-primary">Log in</h1>

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

                    <div class="mt-4">
                        <v-text-field
                            v-model="form.password"
                            label="Password"
                            :error-messages="form.errors.password"
                            @click="form.errors.password=null"
                            type="password"
                            required
                            autocomplete="current-password"
                            variant="solo-filled"
                        ></v-text-field>
                    </div>

                    <div>
                        <v-checkbox
                            v-model="form.remember"
                            label="Remember Me"
                            color="primary"
                            value="1"
                            hide-details
                        ></v-checkbox>
                    </div>

                    <div class="flex items-center justify-lg-space-between mt-4">
                        <v-btn :disabled="form.processing" type="submit" class="mr-2" color="primary">Log In</v-btn>
                        <v-btn :to="route('password.request')" flat>Forgot password</v-btn>
                    </div>
                </form>

            </v-col>
        </v-row>

    </GuestLayout>
</template>
