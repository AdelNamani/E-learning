{{-- 
@extends('layouts.app')


@section('content')
    <p>First name : {{$user->first_name}}</p>
<p>Last name : {{$user->last_name}}</p>
<p>Email : {{$user->email}}</p>
@endsection
 --}}


@extends('layouts.default' , ['id' => null ])



@section('content')
    @include('partials.header')

<main>
    <section id="hero_in" class="general" style="background : url({{asset('img/bg_general.jpg')}}) center center no-repeat;" >
        <div class="wrapper" style="background-color:rgba(0, 0, 0, 0.7);">
            <div class="container">
                <h1 class="fadeInUp"><span></span>Profile detail</h1>
            </div>
        </div>
    </section>
    <!--/hero_in-->
    <div class="container margin_60_35">
        <div class="row">
            <aside class="col-lg-3" id="sidebar">
                <div class="profile">
                    {{-- <figure><img src="http://via.placeholder.com/150x150/ccc/fff/teacher_2_small.jpg"
                            class="rounded-circle"></figure> --}}
                            <h4> Settings </h4>
                    {{-- <ul class="social_teacher">
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-email"></i></a></li>
						</ul> --}}
                    <ul>
                        <li>First Name <span class="float-right">{{ $user->first_name }}</span> </li>
                        <li>Last Name <span class="float-right">{{ $user->last_name }}</span> </li>
                        <li>ُEmail<span class="float-right">{{ $user->email }}</span> </li>
                        <li>
                            <a href="{{route('profile.edit')}}" class="btn_1 rounded"> Edit </a>
                        </li>

                    </ul>
                </div>
            </aside>
            <!--/aside -->

            <div class="col-lg-9">
                <div class="box_teacher">
                    <div class="indent_title_in">
                        <i style="line-height: 1;" class=" icon-layout"></i>
                        <h3>My Courses</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <!-- ForEach user courses -->
                                @foreach ($courses as $course)
                                <div class="col-md-6">
                                    <div class="box_grid wow">
                                        <div class="wrapper">
                                            <h3>{{$course->name}}</h3>
                                            <p>{{$course->description}}</p>
                                        </div>
                                        <ul>
                                            <li>Progress : <i class="icon-progress-2"></i> {{(int)($course->progress * 100)}}%</li>
                                            <li><a href="{{route('course.show',['id'=>$course->id])}}">View course</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                                <!-- ForEach user courses -->
                            </div>
                        </div>
                    </div>

                    <!--wrapper_indent -->
                </div>
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</main>
    @include('partials.footer')
@endsection