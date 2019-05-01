
@extends('layouts.default' , ['id' => null ])

@section('content')

@include('partials.header')

<main>
		<section id="hero_in" class="hero_single version_2">
                <div class="wrapper">
                        <div class="container">
                            <h3>What would you learn?</h3>
                            <p>Increase your expertise in business, technology and personal development</p>
                            <form>
                                <div id="custom-search-input">
                                    <div class="input-group">
                                        <input type="text" class=" search-query" placeholder="Ex. Architecture, Specialization...">
                                        <input type="submit" class="btn_search" value="Search">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
		</section>
		<!--/hero_in-->

		<div class="filters_listing sticky_horizontal">
			{{-- <div class="container">
				<ul class="clearfix">
					<li>
						<div class="switch-field">
							<input type="radio" id="all" name="listing_filter" value="all" checked>
							<label for="all">All</label>
							<input type="radio" id="popular" name="listing_filter" value="popular">
							<label for="popular">Popular</label>
							<input type="radio" id="latest" name="listing_filter" value="latest">
							<label for="latest">Latest</label>
						</div>
					</li>
					<li>
						<div class="layout_view">
							<a href="courses-grid.html"><i class="icon-th"></i></a>
							<a href="#0" class="active"><i class="icon-th-list"></i></a>
						</div>
					</li>
					<li>
						<select name="orderby" class="selectbox">
							<option value="category">Category</option>
							<option value="category 2">Literature</option>
							<option value="category 3">Architecture</option>
							<option value="category 4">Economy</option>
							</select>
					</li>
				</ul>
			</div> --}}
			<!-- /container -->
		</div>
		<!-- /filters -->

		<div class="container margin_60_35">
            @foreach($courses as $course )
            <div class="box_list wow">
                    <div class="row no-gutters">
                        <div class="col-lg-5">
                            <figure class="block-reveal">
                                <div class="block-horizzontal"></div>
                                <a href="{{route('course.show',['id'=>$course->id])}}" ><img 
                                    @if ($course->photo)
                                        src="{{$course->photo}}"
                                    @else
                                        src="{{asset('img/defaultCoursePicture.jpg')}}"
                                    @endif
                                    class="img-fluid" alt=""></a>
                                <div class="preview"><span>Preview course</span></div>
                            </figure>
                        </div>
                        <div class="col-lg-7">
                            <div class="wrapper">
                                {{-- <a href="#0" class="wish_bt"></a> --}}
                                {{-- <div class="price">$39</div> --}}
                                {{-- <small>Category</small> --}}
                                <h3>{{$course->name}}</h3>
                                <p>{{$course->description}}</p>
                                {{-- <div class="rating"><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i><i class="icon_star"></i> <small>(145)</small></div> --}}
                            </div>
                            <ul>
                                {{-- <li><i class="icon_clock_alt"></i> 1h 30min</li> --}}
                                <li><i class="icon-user"></i> {{$course->teacher}}</li>
                                <li><a href="{{route('course.show',['id'=>$course->id])}}">Enroll now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
			
			<!-- /box_list -->
			{{-- <p class="text-center add_top_60"><a href="#0" class="btn_1">Load more</a></p> --}}
		</div>
		<!-- /container -->
		{{-- <div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-help2"></i>
							<h4>Need Help? Contact us</h4>
							<p>Cum appareat maiestatis interpretaris et, et sit.</p>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-wallet"></i>
							<h4>Payments and Refunds</h4>
							<p>Qui ea nemore eruditi, magna prima possit eu mei.</p>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-note2"></i>
							<h4>Quality Standards</h4>
							<p>Hinc vituperata sed ut, pro laudem nonumes ex.</p>
						</a>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div> --}}
		<!-- /bg_color_1 -->
	</main>

@include('partials.footer')
    
@endsection