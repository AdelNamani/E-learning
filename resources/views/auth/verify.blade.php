

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
        <div class="divider"><span>Verify Your Email Address</span></div>
        <br>
            @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
            @endif

    <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
    <p>{{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>. </p>
        <div class="copy">
            © <script>
        document.write(new Date().getFullYear())
        </script> {{config('app.name')}}</div>
    </aside>
</div>
@endsection