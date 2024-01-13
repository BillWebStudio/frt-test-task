<script setup>
import {computed} from "vue";
import { Link, usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

const page = usePage()

const props = defineProps({
    'quiz': Object,
    'stats': Object,
});

const pageTitle = computed(() => {
    return props?.quiz?.title + ' Winners';
});

const items = computed(() => {
    return props.stats;
});


function ct(seconds) {
    return converTime(seconds);
}

</script>

<template>
    <GuestLayout :title="pageTitle" >

        <div>
            <v-table class="admin-table">
                <thead theme="dark">
                <tr><th colspan="20" class="table-totals">Total: {{ items.total }}</th></tr>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Score</th>
                    <th>Time</th>
                    <th>Date</th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="(item, index) in items.data" :key="item.id">
                    <td>{{ (items.current_page-1) * items.per_page + index + 1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.total_score }}</td>
                    <td>{{ ct(item.time_spent) }}</td>
                    <td>{{ item.created_at }}</td>
                </tr>
                </tbody>

                <tfoot>
                <tr>
                    <th colspan="10"></th>
                </tr>
                </tfoot>
            </v-table>

            <app-pagination :items="items"></app-pagination>
        </div>

    </GuestLayout>
</template>
