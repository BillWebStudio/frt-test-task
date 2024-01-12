<script setup>
import { watch } from 'vue'

const props = defineProps({
    quiz: {
        type: Object,
    },
    form: {
        type: Object,
    }
});

function addQuestion(){
    if (props.form.type == 'Binary')
        props.form.questions.push({question : '', answers : ['Yes','No'], valid:'Yes'});
    else
        props.form.questions.push({question : '', answers : ['','',''], valid:''});
}

function deleteQuestion(i){
    props.form.questions.splice(i, 1);
}

function clearValid(i){
    props.form.questions[i]['valid'] = '';
}

watch(
    () => props.form.type, // use a getter
    (type) => {
        props.form.questions = [];
        addQuestion();
    }
)

</script>


<template>
        <v-row>

            <v-col cols="12" md="6">
                <h2 class="mb-5">General Info</h2>

                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            v-model="form.title"
                            label="Title"
                            :error-messages="form.errors.title"
                            @click="form.errors.title=null"
                            variant="solo-filled"
                            required
                        ></v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12">
                        <v-select
                            v-model="form.type"
                            label="Type"
                            :items="$page.props.selectOptions.quizTypes"
                            :error-messages="form.errors.type"
                            @click="form.errors.type=null"
                            variant="solo-filled"
                            required
                        ></v-select>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12">
                        <v-select
                            v-model="form.status"
                            label="Status"
                            :items="$page.props.selectOptions.activeStatuses"
                            :error-messages="form.errors.status"
                            @click="form.errors.status=null"
                            variant="solo-filled"
                            required
                        ></v-select>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="12">
                        <v-text-field
                            v-model="form.duration"
                            label="Duration (in seconds)"
                            :error-messages="form.errors.duration"
                            @click="form.errors.duration=null"
                            variant="solo-filled"
                            required
                        ></v-text-field>
                    </v-col>
                </v-row>

            </v-col>

            <v-col cols="12" md="6">

                <h2 class="mb-5">Questions</h2>

                <div id="questions">
                    <v-row v-for="(item, index) in form.questions">
                        <v-col cols="12">
                            <v-row>
                                <v-col cols="11">
                                    <v-text-field
                                        v-model="item.question"
                                        label="Question"
                                        variant="solo-filled"
                                        required
                                    ></v-text-field>
                                </v-col>
                                <v-col cols="1">
                                    <v-btn color="error" size="x-large" variant="outlined" title="Delete question" @click.prevent="deleteQuestion(index)" ><v-icon icon="mdi-delete"></v-icon></v-btn>
                                </v-col>
                            </v-row>

                            <v-row v-if="form.type == 'Binary'">
                                <v-col cols="3" v-for="(answer, a) in item.answers">
                                    <v-text-field
                                                  v-model="item.answers[a]"
                                                  :label="'Answer ' + (a+1)"
                                                  variant="solo-filled"
                                                  required
                                                  @input="clearValid(index)"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="3">
                                    <v-select
                                              v-model="item.valid"
                                              label="Correct answer"
                                              :items="item.answers"
                                              :default="item.answers[0]"
                                              variant="solo-filled"
                                              required
                                    ></v-select>
                                </v-col>
                            </v-row>

                            <v-row v-else>
                                <v-col cols="3" v-for="(answer, a) in item.answers">
                                    <v-text-field
                                        v-model="item.answers[a]"
                                        :label="'Answer ' + (a+1)"
                                        variant="solo-filled"
                                        required
                                        @input="clearValid(index)"
                                    ></v-text-field>
                                </v-col>

                                <v-col cols="3">
                                    <v-select
                                        v-model="item.valid"
                                        label="Correct answer"
                                        :items="item.answers"
                                        :default="item.answers[0]"
                                        variant="solo-filled"
                                        required
                                    ></v-select>
                                </v-col>
                            </v-row>

                        </v-col>

                    </v-row>

                    <v-row>
                        <v-col cols="12">
                            <v-btn color="info" variant="outlined" title="Add question" @click.prevent="addQuestion" ><v-icon icon="mdi-plus"></v-icon> Add question</v-btn>
                        </v-col>
                    </v-row>
                </div>

            </v-col>

        </v-row>

</template>


<style scoped>

</style>
