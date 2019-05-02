	<header class="header menu_2">
		<div id="preloader"><div data-loader="circle-side"></div></div><!-- /Preload -->
		<div id="logo">
			<a href="{{route('home')}}"><img src="{{asset('img/cufa.png')}}" width="100" data-retina="true" alt=""></a>
		</div>
		{{-- <ul id="top_menu">
			<li><a href="login.html" class="login">Login</a></li>
			<li><a href="#0" class="search-overlay-menu-btn">Search</a></li>
		</ul> --}}
			@auth
			<ul id="top_menu">
					<li class="hidden_tablet"><a href="admission.html" class="btn_1 rounded">Become a Teacher</a></li>
			</ul>
			@endauth
		<!-- /top_menu -->
		<a href="#menu" class="btn_mobile">
			<div class="hamburger hamburger--spin" id="hamburger">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
			</div>
		</a>
		<nav id="menu" class="main-menu">
			<ul>
				@guest
					<li><span><a href="{{ route('login') }}">Login</a></span></li>
					@if (Route::has('register'))
					<li><span><a href="{{ route('register') }}">Register</a></span></li>
					@endif
				@else 
			<li><span><a href="#0">{{ Auth::user()->first_name }}  {{Auth::user()->last_name  }} <i class="icon-down-dir"></i> </a></span>
						<ul>
							<li><a href="{{ route('profile') }}" >Profile</a></li>
							<li><a href="{{ route('logout') }}" onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">Logout</a></li>
						</ul>
					</li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
				@endguest
				
			</ul>
		</nav>
		<!-- Search Menu -->
		{{-- <div class="search-overlay-menu">
			<span class="search-overlay-close"><span class="closebt"><i class="ti-close"></i></span></span>
			<form role="search" id="searchform" method="get">
				<input value="" name="q" type="search" placeholder="Search..." />
				<button type="submit"><i class="icon_search"></i>
				</button>
			</form>
		</div><!-- End Search Menu --> --}}
	</header>