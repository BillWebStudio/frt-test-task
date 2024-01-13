<script setup>
import {computed} from "vue";
import { Link, usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import AdminSearch from "@/Components/Admin/AdminSearch.vue";

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
        {
            name: 'status',
            type: 'select',
            label: 'Status',
            options: page.props.selectOptions.activeStatuses
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
    return props.quizzes;
});


function ct(seconds) {
    return converTime(seconds);
}

</script>

<template>
    <AdminLayout :title="pageTitle" >

        <template v-slot:titleButtons>
            <v-btn size="large" variant="outlined" :to="route('admin.quizzes.create')" title="Add new"><v-icon icon="mdi-plus"></v-icon>Add new</v-btn>
        </template>

        <div>
            <admin-search :form-url="route('admin.quizzes.index')" :search-inputs="searchInputs"></admin-search>

            <v-row>
                <v-col cols="12">

                    <v-table class="admin-table">
                        <thead theme="dark">
                        <tr><th colspan="20" class="table-totals">Total: {{ items.total }}</th></tr>
                        <tr>
                            <th><app-sort label="ID" field="id" /></th>
                            <th><app-sort label="Type" field="type" /></th>
                            <th><app-sort label="Title" field="title" /></th>
                            <th><app-sort label="Duration" field="duration" /></th>
                            <th><app-sort label="# Questions" field="num_questions" /></th>
                            <th><app-sort label="Status" field="status" /></th>
                            <th><app-sort label="Created" field="created_at" /></th>
                            <th class="table-actions">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="item in items.data" :key="item.id">
                            <td><Link :href="route('admin.quizzes.edit', [ item.id ] )" title="Edit">{{ item.id }}</Link></td>
                            <td>{{ $page.props.enums.quizTypes[item.type] }}</td>
                            <td><Link :href="route('admin.quizzes.show', [ item.id ] )" title="View">{{ item.title }}</Link></td>
                            <td>{{ ct(item.duration) }}</td>
                            <td>{{ item.num_questions }} </td>
                            <td>{{ $page.props.enums.activeStatuses[item.status] }}</td>
                            <td>{{ item.created_at }}</td>

                            <td class="table-actions">
                                <v-btn color="info" variant="outlined"  :to="route('admin.quizzes.show', [ item.id ] )" title="View"><v-icon icon="mdi-eye"></v-icon></v-btn>
                                <v-btn color="warning" variant="outlined" :to="route('admin.quizzes.edit', [ item.id ] )" title="Edit"><v-icon icon="mdi-file-edit"></v-icon></v-btn>
                                <v-btn color="error" variant="outlined" class="destroyBtn" :data-url="route('admin.quizzes.destroy', item.id)" title="Delete"><v-icon icon="mdi-delete"></v-icon></v-btn>
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
