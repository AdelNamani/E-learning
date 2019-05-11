
@extends('layouts.default' , ['id' => null ])

@section('css')
    <link rel="stylesheet" href="{{asset('quiz/jquery.quiz.css')}}">
@endsection

@section('content')

@include('partials.header')

<main>
		<section id="hero_in" class="general"  style="background : url({{asset("storage/".$chapter->course->photo)}}) center center no-repeat;">
			<div class="wrapper" style="background-color:rgba(0, 0, 0, 0.7);">
				<div class="container">
                    @if($completed)
                    <h1 class="fadeInUp"><span></span>Quiz - {{$chapter->name}}</h1>
                    <a href="#" id="quiz-start-btn" class="btn_1 rounded">Start Quiz</a>
                    @else
                    <h1 class="fadeInUp"><span></span> Complete all chapter lessons first ! </h1>
                    @endif
				</div>
			</div>
		</section>
		<!--/hero_in-->
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-10" id="faq">
                    @if($completed)
                    <div id="quiz">
                        {{-- <div id="quiz-header">
                            <h1>Quiz Example</h1>
                            <p><a id="quiz-home-btn">Quiz Home</a></p>
                        </div> --}}
                        <div id="quiz-start-screen">
            
                        </div>
                    </div>
                    @endif
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->
        </div>
		<!--/container-->
	</main>

@include('partials.footer')

@endsection

@section('js')
    <script src="{{asset('quiz/jquery.quiz.js')}}"></script>
    <script>
        const myQuiz = [
            @php
                $correct_index = 0;
            @endphp
            @foreach($chapter->questions as $question)
            {
                'q': '{{$question->statement}} ?',
                'options': [
                    @foreach($question->propositions as $proposition)
                    '{{$proposition->statement}}',
                        @if($proposition->is_correct)
                            @php
                                $correct_index = $loop->index
                            @endphp
                        @endif
                    @endforeach
                ],
                'correctIndex':{{$correct_index}} ,
                // 'correctResponse': 'Well done !',
                // 'incorrectResponse': 'Bad answer !'
            },
            @endforeach

        ];

        $('#quiz').quiz({

            questions: myQuiz,

            // allows incorrect options
            allowIncorrect: true,

            // counter settings
            counter: true,
            counterFormat: '%current/%total',

            // default selectors & format
            startScreen: '#quiz-start-screen',
            startButton: '#quiz-start-btn',
            homeButton: '#quiz-home-btn',
            resultsScreen: '#quiz-results-screen',
            resultsFormat: 'You got %score out of %total correct!',
            gameOverScreen: '#quiz-gameover-screen',

            // button text
            nextButtonText: 'Next',
            finishButtonText: 'Finish',
            restartButtonText: 'Restart',
            backToCourse : '{{route("course.show" , ["id" => $chapter->course->id ])}}' ,
            answerCallback: function(){
            // do something
            },

            nextCallback: function(){
            // do something
            },

            finishCallback: function(score){
                console.log(score);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    type: "POST",
                    url : '{{route('chapter.quizSubmit',['id'=>$chapter->id])}}',
                    data : {
                        'score' : score,
                    },
                    success : function (data){
                        console.log(data);
                    },
                    error : function(data){
                        console.log(data);
                    }

                })
            },

            homeCallback: function(){
            // do something
            },

        });

    </script>

@endsection