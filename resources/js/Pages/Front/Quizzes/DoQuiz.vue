<script setup>
import {computed} from "vue";
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    quiz: {
        type: Object,
    },
});

const pageTitle = computed(() => {
    return 'Quizzes > View';
});

</script>

<template>
    <AdminLayout :title="pageTitle" >

        <div>
            <v-container>

                <v-row>

                    <v-col cols="12" md="6">
                        <h2 class="mb-5">General Info</h2>

                        <v-row class="row">
                            <v-col calls="12" sm="3"><strong>Title:</strong></v-col>
                            <v-col calls="12" sm="9">{{ quiz.title }}</v-col>
                        </v-row>

                        <v-row class="row">
                            <v-col calls="12" sm="3"><strong>Type:</strong></v-col>
                            <v-col calls="12" sm="9">{{ $page.props.enums.quizTypes[quiz.type] }}</v-col>
                        </v-row>

                        <v-row class="row">
                            <v-col calls="12" sm="3"><strong>Status:</strong></v-col>
                            <v-col calls="12" sm="9">{{ $page.props.enums.activeStatuses[quiz.status] }}</v-col>
                        </v-row>

                        <v-row class="row">
                            <v-col calls="12" sm="3"><strong>Duration:</strong></v-col>
                            <v-col calls="12" sm="9">{{ quiz.duration }} s</v-col>
                        </v-row>
                        <v-row class="row">
                            <v-col calls="12" sm="3"><strong># Questions:</strong></v-col>
                            <v-col calls="12" sm="9">{{ quiz.num_questions }}</v-col>
                        </v-row>
                        <v-row class="row">
                            <v-col calls="12" sm="3"><strong>Created:</strong></v-col>
                            <v-col calls="12" sm="9">{{ quiz.created_at }}</v-col>
                        </v-row>
                    </v-col>

                    <v-col cols="12" md="6">
                        <h2 class="mb-5">Questions</h2>

                        <div id="questions">
                            <v-row v-for="(item, index) in quiz.questions">
                                <v-col cols="12" >
                                    <h3>{{ item.question }}</h3>

                                    <v-list>
                                        <v-list-item v-for="(answer, a) in item.answers" :class="{'bg-green': answer == item.valid }">
                                            {{ a+1 }}. {{ answer }}
                                        </v-list-item>
                                    </v-list>

                                    <v-divider></v-divider>

                                </v-col>
                            </v-row>

                        </div>


                    </v-col>

                </v-row>

                <v-col class="d-flex align-center mt-4 ga-2">
                    <v-btn color="primary" variant="outlined" size="large" :to="route('admin.quizzes.index')" title="Index">Index</v-btn>
                    <v-btn color="warning" size="large" :to="route('admin.quizzes.edit', quiz.id)" title="Edit">Edit</v-btn>
                    <v-btn color="error" size="large" class="destroyBtn" :data-url="route('admin.quizzes.destroy', quiz.id)" title="Delete">Delete</v-btn>
                </v-col>

            </v-container>

        </div>

    </AdminLayout>
</template>

<style scoped>

</style>
