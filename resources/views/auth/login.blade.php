
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
    <form autocomplete="off" action="{{route('login')}}" method="POST">
        @csrf
            <div class="form-group">
                <div class="divider"><span>Login</span></div>
                <span class="input">
                <input class="input_field" id="email" type="email"  name="email" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="error_message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label class="input_label">
                    <span class="input__label-content">Your Email</span>
                </label>
                </span>
                <span class="input">

                        
                <input class="input_field" id="password" type="password"  name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="error_message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label class="input_label">
                    <span class="input__label-content">Your Password</span>
                </label>
                </span>
                @if (Route::has('password.request'))
                <a class="text-center add_top_10" href="{{ route('password.request') }}">
                    <strong>
                            {{ __('Forgot Your Password?') }}
                    </strong>
                </a>
                @endif
                {{-- <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                </label> --}}
                <div id="pass-info" class="clearfix"></div>
            </div>
                    <button type="submit" class="btn_1 rounded full-width add_top_30">Login to {{config('app.name')}}</button>
                    <div class="text-center add_top_10">New to {{config('app.name')}}? <strong><a href="{{route('register')}}">Sign up!</a></strong></div>        </form>

           
        <div class="copy">
            © <script>
        document.write(new Date().getFullYear())
        </script> {{config('app.name')}}</div>
    </aside>
</div>
@endsection