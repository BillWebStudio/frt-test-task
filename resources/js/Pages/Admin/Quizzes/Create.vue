<script setup>
import {computed} from "vue";
import { useForm, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import FormFields from "@/Pages/Admin/Quizzes/formFields.vue";

const props = defineProps({
    quiz: {
        type: Object,
    }
});

const page = usePage();

const pageTitle = computed(() => {
    return 'Quizzes > Add';
});


const form = useForm({
    title: props?.quiz?.title || '',
    type: props?.quiz?.type || 'Binary',
    status: props?.quiz?.status || 1,
    duration: props?.quiz?.duration || 30,
    questions: props?.quiz?.questions || [{question : '', answers : ['Yes','No'], valid:'Yes'}]
});

const submit = () => {
    form.post(route('admin.quizzes.store'), {});
};


</script>

<template>
    <AdminLayout :title="pageTitle" >

        <div>

            <v-form @submit.prevent="submit" class="my-4">
                <v-container>
                    <form-fields :form="form" :quiz="quiz"></form-fields>

                    <v-col class="d-flex align-center ga-2">
                        <v-btn :disabled="form.processing" type="submit" color="primary" size="large" title="Save">Save</v-btn>
                        <v-btn color="primary" variant="outlined" size="large" :to="route('admin.quizzes.index')" title="Cancel">Cancel</v-btn>
                    </v-col>

                </v-container>

            </v-form>

        </div>

    </AdminLayout>
</template>

<style scoped>

</style>
