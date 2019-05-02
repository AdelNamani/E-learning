
@extends('layouts.default' , ['id' => null]) 

@section('content')

@include('partials.header')
<input type="hidden" id="lessonId" name="Var1" value="salam" />
<input type="hidden" id="checkLesson" name="Var2" value="salam" />

<main>
		<section id="hero_in" class="courses">
			<div class="wrapper" style="background : url({{$course->photo}}) center center no-repeat;">
				<div class="container">
					<h1 class="fadeInUp"><span></span> {{$course->name}}</h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->

		<div class="bg_color_1">
			<nav class="secondary_nav sticky_horizontal">
				<div class="container">
					<ul class="clearfix">
						<li><a href="#description" class="active">Description</a></li>
						<li><a href="#lessons">Lessons</a></li>
						{{-- <li><a href="#reviews">Reviews</a></li> --}}
					</ul>
				</div>
			</nav>
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-8">
						<section id="description">
                            <h2>Description</h2>
                            <p>{{$course->description}}</p>
							{{-- <h5>What will you learn</h5>
							<ul class="list_ok">
								<li>
									<h6>Suas summo id sed erat erant oporteat</h6>
									<p>Ut unum diceret eos, mel cu velit principes, ut quo inani dolorem mediocritatem. Mea in justo posidonium necessitatibus.</p>
								</li>
								<li>
									<h6>Illud singulis indoctum ad sed</h6>
									<p>Ut unum diceret eos, mel cu velit principes, ut quo inani dolorem mediocritatem. Mea in justo posidonium necessitatibus.</p>
								</li>
								<li>
									<h6>Alterum bonorum mentitum an mel</h6>
									<p>Ut unum diceret eos, mel cu velit principes, ut quo inani dolorem mediocritatem. Mea in justo posidonium necessitatibus.</p>
								</li>
							</ul> --}}
							<hr>
							
							<!-- /row -->
						</section>
						<!-- /section -->
						
						<section id="lessons">
							<div class="intro_title">
								<h2>Lessons</h2>
								<ul>
									{{-- <li>lessons</li> --}}
									{{-- <li>01:02:10</li> --}}
								</ul>
							</div>
							<div id="accordion_lessons" role="tablist" class="add_bottom_45">
                                @foreach($course->chapters as $chapter)
                                <div class="card">
                                        <div class="card-header" role="tab" id="headingOne">
                                            <h5 class="mb-0">
                                                <a data-toggle="collapse" href="#{{$chapter->id}}" aria-expanded="true" aria-controls="{{$chapter->id}}"><i class="indicator ti-minus"></i> {{$chapter->name}}</a>
                                            </h5>
                                        </div>
    
                                        <div id="{{$chapter->id}}" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion_lessons">
                                            <div class="card-body">
                                                <div class="list_lessons">
                                                    <ul>
                                                        @foreach($chapter->lessons as $lesson)
                                                            <li> 
																@if($lesson->users->contains(Auth::user()))
																{{-- @if(0) --}}
                                                                    <i style="color : green !important ;" class="icon-ok"></i> 
                                                                    {{-- <a aria-disabled="true" class="video"> {{$lesson->name}} </a></li> --}}
                                                                @else
                                                                    <i class="icon-play-circled2"></i> 
																@endif
															<a href="{{$lesson->video}}" data-var1="{{$lesson->id}}" data-var2="{{$lesson->users->contains(Auth::user())}}" class="video video-click"> {{$lesson->name}} </a></li>
																{{-- <a href="https://www.youtube.com/watch?v=eEKfWVvADiQ" class="video"> {{$lesson->name}} </a></li> --}}
                                                        @endforeach
                                                        <li><a href="{{$chapter->support}}" class="txt_doc">Chapter support</a></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endforeach
								<!-- /card -->
							</div>
							<!-- /accordion -->
						</section>
					
					</div>
					<!-- /col -->
						</div>
					</aside>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
	</main>

@include('partials.footer')

    
@endsection

@section('js')
	<script>
		var completeLessonRoute = null ; 
		$('.video').click(function(){	
			$('#lessonId').val($(this).data('var1'));
			$('#checkLesson').val($(this).data('var2'));
		}).magnificPopup({
				type:'iframe' , 
				iframe: {
					markup: '<div class="mfp-iframe-scaler">'+
										'<div class="mfp-close"></div>'+
										'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
										"<button id='noob' class='btn_1 complete-button'>I've completed this lesson</button>"+
							'</div>',
				} ,
				callbacks : {
					beforeOpen: function() {						
						completeLessonRoute = '/lesson/' + $('#lessonId').val() + '/complete' ; 
				  },
				  	open : function () {
						  if ( $('#checkLesson').val() == 1) {
										$('#noob').css('display' , 'none');
						  } else {
										$('#noob').css('display' , 'block');
						  }
						$('#noob').click(function () {	
							$.ajax({
								headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
								type: "GET",
								url: completeLessonRoute,
								beforeSend : function () {
									$('#noob').html(
										'<svg class="spinner" width="20px" height="20px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg"> <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle> </svg>'
								);
								},
								success: function (data) {
									if (data.error == null) {
										$('#noob').html("You've already completed that lesson");
										$('#noob').css('background-color' , 'green');
									}
								},
								error: function (response) {
									console.log("error");
								}

							})
					});
					  }
				}
			});		

			

	</script>
@endsection