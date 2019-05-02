
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
                    {{-- <div class="text-center add_top_10">New to {{config('app.name')}}? <strong><a href="{{route('register')}}">Sign up!</a></strong></div> --}}
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
                    {{-- <div class="text-center add_top_10">New to {{config('app.name')}}? <strong><a href="{{route('register')}}">Sign up!</a></strong></div> --}}
    </form>

           
        <div class="copy">
            © <script>
        document.write(new Date().getFullYear())
        </script> {{config('app.name')}}</div>
    </aside>
</div>
@endsection