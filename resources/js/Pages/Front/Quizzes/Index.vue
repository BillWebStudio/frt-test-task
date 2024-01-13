<script setup>
import {computed} from "vue";
import { Link, usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import AdminSearch from "@/Components/Admin/AdminSearch.vue";
import moment from "moment";

const page = usePage()

const props = defineProps({
    'quizzes': Object,
});

const pageTitle = computed(() => {
    return 'Quizzes';
});

//Have to make computed in order to make trans work on 1st load
const searchInputs = computed(() => {
    return [
        {
            name: 's',
            type: 'text',
            label: 'Keyword',
        },
        {
            name: 'type',
            type: 'select',
            label: 'Type',
            options: page.props.selectOptions.quizTypes
        },
    ];
});

const items = computed(() => {
    return props.quizzes;
});


function ct(seconds) {
    return converTime(seconds);
}

</script>

<template>
    <GuestLayout :title="pageTitle" >

        <template v-slot:titleButtons>
            <v-btn size="large" variant="outlined" :to="route('admin.quizzes.create')" title="Add new"><v-icon icon="mdi-plus"></v-icon>Add new</v-btn>
        </template>

        <div>
            <admin-search :form-url="route('quizzes.index')" :search-inputs="searchInputs"></admin-search>

            <v-row class="ga-2">
                <v-col cols="4" v-for="item in items.data" :key="item.id" class="border">
                    <h3 class="mb-3">{{ item.title }}</h3>
                    <div class="mb-3"># Questions: {{ item.num_questions }} </div>
                    <div class="mb-3">Duration: {{ ct(item.duration) }} </div>

                    <div class="ga-2 d-flex">
                        <v-btn color="success" :to="route('quizzes.do', [ item.id ] )" title="View">Start the Quiz</v-btn>
                        <v-btn color="info" variant="outlined" :to="route('quizzes.stats', [ item.id ] )" title="Edit">View Statistics</v-btn>
                    </div>
                </v-col>

            </v-row>

            <app-pagination :items="items"></app-pagination>
        </div>

    </GuestLayout>
</template>
