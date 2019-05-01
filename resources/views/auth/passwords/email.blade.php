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
    <form autocomplete="off" action="{{ route('password.email') }}" method="POST">
        @csrf
            <div class="form-group">
                <div class="divider"><span>Reset Password</span></div>
                <span class="input">
                    <input id="email" type="email" class="input_field" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="error_message" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    <label class="input_label">
                    <span class="input__label-content">Your Email</span>
                </label>
                </span>
                
                <div id="pass-info" class="clearfix"></div>
            </div>
                    <button type="submit" class="btn_1 rounded full-width add_top_30">{{ __('Send Password Reset Link') }}</button>

           
        <div class="copy">
            © <script>
        document.write(new Date().getFullYear())
        </script> {{config('app.name')}}</div>
    </aside>
</div>
@endsection