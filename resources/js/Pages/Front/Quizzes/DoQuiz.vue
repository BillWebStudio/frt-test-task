<script setup>
import {computed, ref} from "vue";
import { useForm, usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    quiz: {
        type: Object,
    },
});

const pageTitle = computed(() => {
    return 'Quizzes > ' + props.quiz.title;
});


let currentQ = ref(1);

const currentQstep = computed(() => {
    return currentQ.value + ' / ' + props?.quiz?.questions.length;
});


const formDefaults = {
    quiz_id: props.quiz.id,
    step: 'personalInfo', //personalInfo, quiz, summary
    first_name: '',
    last_name: '',
    email: '',
    time_spent: 0,
    total_score: 0,
    num_questions: props?.quiz?.questions.length,
    answered_questions: 0,
    unanswered_questions: props?.quiz?.questions.length,
    questions: props?.quiz?.questions
};


let form = useForm(formDefaults);


let counter = ref(props?.quiz?.duration || 0);

let counterInterval = null;

const ct = (seconds) => {
    return converTime(seconds);
}

const submitPersonalInfo = () => {
    form.post(route('quizzes.store', props.quiz.id), {
        onSuccess: () => {
            form.step = 'quiz';

            counterInterval = setInterval(function () {
                if (counter.value <= 0)
                {
                    clearInterval(counterInterval);
                    return;
                }
                counter.value--;
            }, 1000);
        }
    });
};


let submitAnswer = ref(false);

const submitAnswerPreview = () => {
    if (form.questions[currentQ.value-1].userAnswer){
        submitAnswer.value = true;
    }
}

const nextQuestion = () => {
    submitAnswer.value = false;

    if (form.questions[currentQ.value-1].userAnswer == form.questions[currentQ.value-1].valid){
        form.answered_questions++;
        form.unanswered_questions--;
    }

    if (currentQ.value < form.questions.length)
        currentQ.value++;
}

const submitQuiz = () => {
    nextQuestion();
    clearInterval(counterInterval);

    form.total_score = form.answered_questions / form.num_questions;
    form.time_spent = props?.quiz?.duration - counter.value;

    form.post(route('quizzes.store', props.quiz.id), {
        onSuccess: () => {
            form.step = 'summary';
           // submitAnswer.value = false;
        }
    });
}

const restartQuiz = () => {
    for (let key in formDefaults){
        if (!['first_name', 'last_name', 'email'].includes(key))
            form[key] = formDefaults[key];
    }

    form.step = 'personalInfo';
    currentQ.value = 1;
    counter.value = props?.quiz?.duration || 0;
}

</script>

<template>
    <GuestLayout :title="pageTitle" >

        <div>
            <v-container>

                {{ form }}

                <v-row class="justify-center">

                    <v-col cols="12" md="8" v-if="form.step == 'personalInfo'">

                        <v-row class="row">
                            <v-col cols="12">
                                <h2>Personal Info:</h2>

                                <v-form class="my-4">

                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="form.first_name"
                                                label="First Name"
                                                :error-messages="form.errors.first_name"
                                                @click="form.errors.first_name=null"
                                                variant="solo-filled"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                v-model="form.last_name"
                                                label="Last Name"
                                                :error-messages="form.errors.last_name"
                                                @click="form.errors.last_name=null"
                                                variant="solo-filled"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col cols="12">
                                            <v-text-field
                                                type="email"
                                                v-model="form.email"
                                                label="Email"
                                                :error-messages="form.errors.email"
                                                @click="form.errors.email=null"
                                                variant="solo-filled"
                                                required
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>

                                    <v-row>
                                        <v-col class="d-flex align-center mt-4 justify-space-between">
                                            <v-btn color="primary" variant="outlined" :to="route('quizzes.index')" title="Cancel">Cancel</v-btn>
                                            <v-btn color="success" :disabled="form.processing" title="Start Quiz" @click.prevent="submitPersonalInfo">Start Quiz ></v-btn>
                                        </v-col>
                                    </v-row>

                                </v-form>

                            </v-col>
                        </v-row>

                    </v-col>

                    <v-col cols="12" md="8" v-if="form.step == 'quiz'">

                        <v-row class="row">
                            <v-col cols="12">
                                <div class="justify-space-between d-flex">
                                    <div>Question {{ currentQstep }}</div>
                                    <div class="pa-2" :class="{'bg-red':counter<=10, 'bg-green':counter>10}">{{ ct(counter) }}</div>
                                </div>

                                <h3>{{ currentQ }}. {{ quiz.questions[currentQ-1].question}}</h3>

                                <v-form  class="my-4">

                                    <div v-if="!submitAnswer || !form.questions[currentQ-1].userAnswer">

                                        <v-row v-if="quiz.type == 'Binary'">
                                            <v-col cols="12">
                                                <v-radio-group v-model="form.questions[currentQ-1].userAnswer">
                                                    <v-radio v-for="ans in quiz.questions[currentQ-1].answers" :label="ans" :value="ans"></v-radio>
                                                </v-radio-group>
                                            </v-col>
                                        </v-row>

                                        <v-row v-if="quiz.type != 'Binary'">
                                        <v-col cols="12">
                                            <v-select
                                                v-model="form.questions[currentQ-1].userAnswer"
                                                label=""
                                                :items="quiz.questions[currentQ-1].answers"
                                                hide-details
                                                variant="solo-filled"
                                                required
                                            ></v-select>
                                        </v-col>
                                    </v-row>

                                        <v-row>
                                            <v-col class="d-flex align-center mt-2">
                                                <v-btn color="success" title="Submit" @click.prevent="submitAnswerPreview">Submit</v-btn>
                                            </v-col>
                                        </v-row>

                                    </div>

                                    <div v-if="submitAnswer && form.questions[currentQ-1].userAnswer">
                                        <v-row>
                                            <v-col>
                                                <v-alert color="green" v-if="form.questions[currentQ-1].userAnswer == form.questions[currentQ-1].valid">
                                                    Correct! The right answer is: {{ form.questions[currentQ-1].valid }}
                                                </v-alert>

                                                <v-alert color="red" v-else>
                                                    Sorry, you are wrong! The right answer is: {{ form.questions[currentQ-1].valid }}
                                                </v-alert>
                                            </v-col>
                                        </v-row>

                                        <v-row>
                                            <v-col class="d-flex align-center mt-2 justify-end">
                                                <v-btn v-if="currentQ < form.num_questions" color="success" title="Next" @click.prevent="nextQuestion">Next</v-btn>
                                                <v-btn v-else color="success" :disabled="form.processing" title="Submit Quiz" @click.prevent="submitQuiz">Submit Quiz</v-btn>
                                            </v-col>
                                        </v-row>
                                    </div>


                                </v-form>

                            </v-col>
                        </v-row>

                    </v-col>

                    <v-col cols="12" md="8" v-if="form.step == 'summary'">

                        <h2>Personal Info:</h2>

                        <v-row class="my-4">

                            <v-col cols="12" md="4">
                                <strong>First Name:</strong> {{ form.first_name }}
                            </v-col>

                            <v-col cols="12" md="4">
                                <strong>Last Name:</strong> {{ form.last_name }}
                            </v-col>

                            <v-col cols="12" md="4">
                                <strong>Email:</strong> {{ form.email }}
                            </v-col>

                        </v-row>

                        <v-divider></v-divider>

                        <div class="mt-4 d-flex justify-space-between align-center">
                            <h2 class="">Quiz results:</h2>
                            <div>Score: {{ form.answered_questions }}/{{ form.num_questions }}</div>
                            <div>Time: {{ ct(form.time_spent) }}</div>
                        </div>

                        <div class="my-4">

                            <v-row v-for="(item, index) in form.questions">
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

                        <v-row>
                            <v-col class="d-flex align-center mt-4 justify-space-between">
                                <v-btn color="primary" variant="outlined" :to="route('quizzes.index')" title="Index">Index</v-btn>
                                <v-btn color="success" title="Restart Quiz" @click.prevent="restartQuiz">Restart Quiz</v-btn>
                            </v-col>
                        </v-row>

                    </v-col>

                </v-row>

            </v-container>

        </div>

    </GuestLayout>
</template>

<style scoped>

</style>
