{{-- 
@extends('layouts.default' , ['id' => 'login_bg'])

@section('content')
<nav id="menu" class="fake_menu"></nav>
	
<div id="preloader">
    <div data-loader="circle-side"></div>
</div>
<!-- End Preload -->

<div id="login">
    <aside>
        <figure>
            <a href="index.html"><img src={{asset('img/cufa.png')}} width="149" data-retina="true" alt=""></a>
        </figure>
    <form autocomplete="off" action="{{route('profile.update_info')}}" method="POST">
        @csrf
            <div class="form-group">
                <div class="divider"><span>Edit Profile</span></div>
                <span class="input">
                <input class="input_field" id="email"  type="text" name="first_name" value="{{$user->first_name}}" required autocomplete="email" autofocus>
                    <label class="input_label">
                    <span class="input__label-content">First Name</span>
                </label>
                </span>
                <span class="input">
                <input class="input_field" id="email"  type="text" name="last_name" value="{{$user->last_name}}" required autocomplete="email" autofocus>
                    <label class="input_label">
                    <span class="input__label-content">Last Name</span>
                </label>
                </span>
                <span class="input">
                <input class="input_field" id="email"  type="text" name="email" value="{{$user->email}}" required autocomplete="email" autofocus>
                    <label class="input_label">
                    <span class="input__label-content">Email</span>
                </label>
                </span>
                <div id="pass-info" class="clearfix"></div>
            </div>
                    <button type="submit" class="btn_1 rounded full-width add_top_30"> Submit </button>
    </form>
    <form autocomplete="off" action="{{route('profile.update_password')}}" method="POST">
        @csrf
            <div class="form-group">
                <div class="divider"><span>Change Password</span></div>
                <span class="input">
                <input class="input_field" id="email" type="password" name="old_password" required autocomplete="email" autofocus>
                    <label class="input_label">
                    <span class="input__label-content"> Old Password</span>
                </label>
                </span>
                <span class="input">
                <input class="input_field" id="email" type="password" name="password" required autocomplete="email" autofocus>
                    <label class="input_label">
                    <span class="input__label-content">New Password</span>
                </label>
                </span>
                <span class="input">
                <input class="input_field" id="email" type="password" name="password_confirmation" required autocomplete="email" autofocus>
                    <label class="input_label">
                    <span class="input__label-content">Confirm Password</span>
                </label>
                </span>
                <div id="pass-info" class="clearfix"></div>
            </div>
                    <button type="submit" class="btn_1 rounded full-width add_top_30"> Submit </button>
    </form>

           
        <div class="copy">
            © <script>
        document.write(new Date().getFullYear())
        </script> {{config('app.name')}}</div>
    </aside>
</div>
@endsection --}}

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
     <section id="hero_in" class="general">
         <div class="wrapper">
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
                     <figure><img src="http://via.placeholder.com/150x150/ccc/fff/teacher_2_small.jpg" alt="Teacher"
                             class="rounded-circle"></figure>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box_general padding_bottom">
                                <div class="header_box version_2">
                                    <h4><i class="icon-lock"></i>Change password</h4>
                                </div>
                                <form autocomplete="off" action="{{route('profile.update_password')}}" method="POST">
                                    @csrf                            
                                <div class="form-group">
                                    <label>Old password</label>
                                    <input type="password" name="old_password" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>New password</label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Confirm new password</label>
                                    <input class="form-control" type="password" name="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn_1 rounded full-width add_top_30"> Submit </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box_general padding_bottom">
                                <div class="header_box version_2">
                                    <h2><i class="icon-user-1"></i>Edit infos</h2>
                                </div>
                                <form autocomplete="off" action="{{route('profile.update_info')}}" method="POST">
                                    @csrf
                            
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="first_name" value="{{$user->first_name}}" required >
                                </div>
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input class="form-control"  type="text" name="last_name" value="{{$user->last_name}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control"  type="text" name="email" value="{{$user->email}}" required >
                                </div>
                                <button type="submit" class="btn_1 rounded full-width add_top_30"> Submit </button>
                                </form>
                            </div>
                        </div>
                    </div>
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