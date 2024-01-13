<script setup>
import {computed} from "vue";
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    clientQuiz: {
        type: Object,
    },
});

const pageTitle = computed(() => {
    return props?.clientQuiz?.name + ' > ' + props?.clientQuiz?.quiz?.title ;
});

const ct = (seconds) => {
    return converTime(seconds);
}

</script>

<template>
    <AdminLayout :title="pageTitle" >

        <div>
            <v-container>

                <v-row class="justify-center">

                    <v-col cols="12" md="8">
                        <h2>Personal Info:</h2>

                        <v-row class="my-4">

                            <v-col cols="12" md="4">
                                <strong>First Name:</strong> {{ clientQuiz.first_name }}
                            </v-col>

                            <v-col cols="12" md="4">
                                <strong>Last Name:</strong> {{ clientQuiz.last_name }}
                            </v-col>

                            <v-col cols="12" md="4">
                                <strong>Email:</strong> {{ clientQuiz.email }}
                            </v-col>

                        </v-row>

                        <v-divider></v-divider>

                        <div class="mt-4 d-flex justify-space-between align-center">
                            <h2 class="">Quiz results:</h2>
                            <div>Score: {{ clientQuiz.total_score }} ({{ clientQuiz.answered_questions }}/{{ clientQuiz.num_questions }})</div>
                            <div>Time: {{ ct(clientQuiz.time_spent) }}</div>
                        </div>

                        <div class="my-4">

                            <v-row v-for="(item, index) in clientQuiz.questions">
                                <v-col cols="12" >
                                    <h3>{{ item.question }}</h3>

                                    <v-alert color="green" v-if="item.userAnswer == item.valid">
                                        {{ item.valid }}
                                    </v-alert>

                                    <v-alert color="red" v-else>
                                        {{ item.valid }}
                                    </v-alert>

                                    <v-divider></v-divider>

                                </v-col>
                            </v-row>
                        </div>

                        <v-row >
                            <v-col class="d-flex align-center ga-2">
                                <v-btn color="primary" variant="outlined" size="large" :to="route('admin.clients-quizzes.index')" title="Index">Index</v-btn>
                            </v-col>
                        </v-row>

                    </v-col>

                </v-row>

            </v-container>

        </div>

    </AdminLayout>
</template>

<style scoped>

</style>
