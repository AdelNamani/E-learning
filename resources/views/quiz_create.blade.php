@extends('layouts.admin')
@section('css')
<link href="{{asset('css/style.css')}}" rel="stylesheet">

@endsection
@section('content')

<div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Create a quiz for {{$chapter->name}}</h2>
        </div>
                <div class="row">
                    <div class="col-lg-10" id="quizCreator">
                        {{-- <h2 class="nomargin_top">Questions :</h2> --}}
                        <div class="form-group">
                            <label>Add question :</label>
                            <input class="form-control" type="text" v-model="new_question">
                        </div>
                        <button v-on:click="add_question()" class="btn_1 medium">Add</button>
                        <br>
                        <br>
                        <div role="tablist" class="add_bottom_45 accordion_2" id="tips" v-for="(question , index) in questions">
                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5 class="mb-0">
                                        <a style="display : inline ;" data-toggle="collapse" :href=" '#'+ question.id" aria-expanded="true"><i class="indicator fa fa-caret-down"></i> @{{question.statement}}</a>
                                        <a style="display : inline ;" href="google.com"><i class=" indicator fa fa-edit"></i></a>
                                        <a style="display : inline ;" href="google.com"><i class=" indicator fa fa-trash"></i></a>
                                    </h5>
                                </div>
    
                                <div :id="question.id" class="collapse show" role="tabpanel" data-parent="#payment">
                                    <div class="card-body">
                                            <p v-for="proposition in question.propositions">
                                                    @{{proposition.statement}}
                                                    <a style="display : inline ;" href="google.com"><i class=" indicator fa fa-edit"></i></a>
                                                    <a style="display : inline ;" href="google.com"><i class=" indicator fa fa-trash"></i></a>
                                            </p>
    
                                    </div>
                                </div>
                            </div>      
                            <div class="form-group">
                                <label> Add a proposition</label>    
                                <input class="form-control" type="text" v-model="question.new_proposition">
                            </div>                
                            <div class="form-group">
                                <label>
                                        Correct : 
                                </label>
                                <input type="checkbox" v-model="question.new_proposition_correct">
                            </div>
    
                            <button v-on:click="add_proposition(index)" class="btn_1 medium">Add</button>
    
                            <br>
    
                        </div>
                    </div>
                </div>
</div>

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