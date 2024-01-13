<script setup>
import {computed} from "vue";
import { Link, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import AdminSearch from "@/Components/Admin/AdminSearch.vue";

const page = usePage()

const props = defineProps({
    'quizzes': Object,
    'stats': Object,
});

const pageTitle = computed(() => {
    return 'Quizzes > Stats';
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
            name: 'quiz_id',
            type: 'select',
            label: 'Quiz',
            options: props.quizzes
        },

        {
            name: 'from_date',
            type: 'date',
            label: 'From Date',
        },
        {
            name: 'to_date',
            type: 'date',
            label: 'To Date',
        }
    ];
});

const items = computed(() => {
    return props.stats;
});


function ct(seconds) {
    return converTime(seconds);
}

</script>

<template>
    <AdminLayout :title="pageTitle" >

        <div>
            <admin-search :form-url="route('admin.clients-quizzes.index')" :search-inputs="searchInputs"></admin-search>

            <v-row>
                <v-col cols="12">

                    <v-table class="admin-table">
                        <thead theme="dark">
                        <tr><th colspan="20" class="table-totals">Total: {{ items.total }}</th></tr>
                        <tr>
                            <th>ID</th>
                            <th>Quiz</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Score</th>
                            <th>Time Spent</th>
                            <th>Answered</th>
                            <th>Unanswered</th>
                            <th>Created</th>
                            <th class="table-actions">Details</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="item in items.data" :key="item.id">
                            <td>{{ item.id }}</td>
                            <td>{{ item?.quiz?.title }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.total_score }}</td>
                            <td>{{ ct(item.time_spent) }}</td>
                            <td>{{ item.answered_questions }} </td>
                            <td>{{ item.unanswered_questions }}</td>
                            <td>{{ item.created_at }}</td>
                            <td class="table-actions">
                                <v-btn color="info" variant="outlined"  :to="route('admin.clients-quizzes.details', [ item.id ] )" title="View"><v-icon icon="mdi-eye"></v-icon></v-btn>
                            </td>
                        </tr>
                        </tbody>

                        <tfoot>
                        <tr>
                            <th colspan="10"></th>
                        </tr>
                        </tfoot>
                    </v-table>

                    <app-pagination :items="items"></app-pagination>

                </v-col>
            </v-row>

        </div>

    </AdminLayout>
</template>
