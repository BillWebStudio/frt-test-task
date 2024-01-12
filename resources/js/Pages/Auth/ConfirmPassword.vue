<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout title>
        <Head title="Confirm password" />

        <v-row justify="center">
            <v-col cols="12" lg="6">
                <h1 class="text-primary">Confirm password</h1>

                <div class="mb-4 text-sm text-gray">
                    This is a secure area of the application. Please confirm your password before continuing.
                </div>

                <form @submit.prevent="submit">
                    <div>
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
                                autofocus
                            ></v-text-field>
                        </div>

                    </div>

                    <div class="flex items-center justify-lg-space-between mt-4">
                        <v-btn :disabled="form.processing" type="submit" class="mr-2" color="primary">Confirm</v-btn>
                    </div>

                </form>

            </v-col>
        </v-row>


    </GuestLayout>
</template>
