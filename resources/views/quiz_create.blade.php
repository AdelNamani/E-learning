@extends('layouts.default' , ['id' => null ])

@section('content')

    @include('partials.header')

    <main xmlns:v-on="http://www.w3.org/1999/xhtml">
        <section id="hero_in" class="general">
            <div class="wrapper">
                <div class="container">
                    <h1 class="fadeInUp"><span></span>Create a quiz for {{$chapter->name}}</h1>
                    <a href="#" id="quiz-start-btn" class="btn_1 rounded">Start</a>
                </div>
            </div>
        </section>

        <div class="container margin_60_35">
            <div class="row">
                <div class="col-lg-10" id="quizCreator">
                    <h2>Questions :</h2>

                    <label>Add question :</label>
                    <input type="text" v-model="new_question">
                    <button v-on:click="add_question()">Add</button>

                    <br>
                    <ul v-for="(question , index) in questions">

                        <h4>Question :</h4>

                        <li> @{{question.statement}}</li>

                        <h4>Propositions :</h4>

                        <ul v-for="proposition in question.propositions">

                            <li v-text="proposition.statement"></li>

                        </ul>

                        <input type="text" v-model="question.new_proposition" placeholder="Add a proposition">

                        Correct : <input type="checkbox" v-model="question.new_proposition_correct">

                        <button v-on:click="add_proposition(index)">Add</button>

                        <br>

                    </ul>
                </div>
            </div>
        </div>

    </main>

    @include('partials.footer')

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        const app = new Vue({
            el: "#quizCreator",
            data: {
                new_question : '',
                questions: [
                        @foreach($chapter->questions as $question)
                    {
                        id: {{$question->id}},
                        statement: '{{$question->statement}}',
                        propositions: [
                                @foreach($question->propositions as $proposition)
                            {
                                statement: '{{$proposition->statement}}',
                                is_correct: {{$proposition->is_correct}}
                            },
                            @endforeach
                        ],
                        new_proposition: '',
                        new_proposition_correct: false,
                    },
                    @endforeach
                ]
            },
            methods: {
                add_proposition: function (question_index) {
                    let con = true
                    console.log(question_index);
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        type: "POST",
                        url: '{{route(('proposition.add'))}}',
                        data: {
                            question_id: this.questions[question_index].id,
                            statement: this.questions[question_index].new_proposition,
                            is_correct: this.questions[question_index].new_proposition_correct ? 1 : 0
                        },
                        success: function (date) {
                            console.log('success');

                        },
                        error: function (data) {
                            console.log('error');
                            con = false
                        }

                    });
                    if (con) {
                        this.questions[question_index].propositions.push({
                            statement: this.questions[question_index].new_proposition,
                            is_correct: false
                        });
                    }

                    this.questions[question_index].new_proposition = '';

                },

                add_question: function () {
                    let con = true;
                    let id = null
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        type: "POST",
                        url: '{{route(('question.add'))}}',
                        data: {
                            chapter_id: {{$chapter->id}},
                            statement: this.new_question,
                        },
                        success: function (data) {
                            console.log('success');
                            id = data.id;


                        },
                        error: function (data) {
                            console.log('error');
                            con = false
                        }

                    });
                    if (con){
                        this.questions.push({
                            id : id,
                            statement : this.new_question,
                            propositions : [

                            ],
                            new_proposition: '',
                            new_proposition_correct: false,
                        });
                    }

                    this.new_question = '';

                }
            }
        });


    </script>

@endsection