
@extends('layouts.default' , ['id' => 'register_bg'])

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
            <form autocomplete="off" action="{{route('register')}}" method="POST">
                @csrf
                <div class="form-group">
                <div class="divider"><span>Register</span></div>
                <span class="input">
                <input id="first_name" type="text" class="input_field" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                                @error('first_name')
                                   <span class="error_message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <label class="input_label">
                    <span class="input__label-content">Your First Name</span>
                </label>
                </span>
                <span class="input">
                        <input id="last_name" type="text" class="input_field" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>

                        @error('last_name')
                        <span class="error_message" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label class="input_label">
                    <span class="input__label-content">Your Last Name</span>
                </label>
                </span>
                <span class="input">
                        <input id="email" type="email" class="input_field" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <input id="password" type="password" class="input_field" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="error_message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <label class="input_label">
                    <span class="input__label-content">Your Password</span>
                </label>
                </span>
                <span class="input">
                        <input id="password-confirm" type="password" class="input_field" name="password_confirmation" required autocomplete="new-password">
                    <label class="input_label">
                    <span class="input__label-content">Confirm Password</span>
                </label>
                </span>
                
                <div id="pass-info" class="clearfix"></div>
            </div>
        <button type="submit" href="#0" class="btn_1 rounded full-width add_top_30">Register to {{config('app.name')}}</button>
        <div class="text-center add_top_10">Already have an acccount? <strong><a href="{{route('login')}}">Sign In</a></strong></div>
        </form>
        <div class="copy">© <script>
            document.write(new Date().getFullYear())
        </script> 
            {{config('app.name')}}
        </div>
    </aside>
</div>s
@endsection