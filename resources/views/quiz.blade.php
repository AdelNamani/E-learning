
@extends('layouts.default' , ['id' => null ])

@section('content')

@include('partials.header')

<main>
		<section id="hero_in" class="general">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>Quiz </h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->

		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-10" id="faq">
                    <h4 class="nomargin_top">Quiz</h4>
                    <form action="" method="post">
                        <div role="tablist" class="add_bottom_45 accordion_2" id="payment">
                            @foreach($chapter->questions as $question)
                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#collapseOne_payment" aria-expanded="true"><i class="indicator ti-minus"></i>{{$question->statement}}</a>
                                    </h5>
                                </div>

                                <div id="collapseOne_payment" class="collapse show" role="tabpanel" data-parent="#payment">
                                    <div class="card-body">
                                        <div class="container">
                                                @foreach($question->propositions as $proposition)
                                                <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="response1">
                                                        <label class="form-check-label" for="response1">
                                                        {{$proposition->statement}}
                                                        </label>
                                                </div>
                                                <br>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>	
                        <button type="submit" class="btn_1 rounded">Submit Quiz</button>
                    </form>				
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->
		</div>
		<!--/container-->
	</main>

@include('partials.footer')
    
@endsection