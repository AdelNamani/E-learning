<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="ZELLAT Abdelkhalek - Adel NAMANI">
  <title>CUFA - Teacher dashboard</title>

  @yield('css')
  <!-- Bootstrap core CSS-->
<link href="{{asset('admin/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- Main styles -->
<link href="{{asset('admin/css/admin.css')}}" rel="stylesheet">
  <!-- Icon fonts-->
<link href="{{asset('admin/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
  <!-- Plugin styles -->
  {{-- <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> --}}
  <!-- Your custom styles -->
<link href="{{asset('admin/css/custom.css')}}" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
  <a class="navbar-brand" href="{{route('home')}}" style="font-size : 25px ;"> Home </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{route('teacher.courses')}}">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">My Courses</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="{{route('course.create')}}">
              <i class="fa fa-plus"></i>
              <span class="nav-link-text">Add Course</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" href="{{ route('logout') }}" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
        @yield('content')
    </div>
    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © {{config('app.name')}} <script>
            document.write(new Date().getFullYear())
            </script> </small>
        </div>
      </div>
    </footer>
  </div>
    <!-- Scroll to Top Button-->
   
    <!-- Logout Modal-->
 
    <!-- Bootstrap core JavaScript-->
<script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{asset('admin/vendor/chart.js/Chart.js')}}"></script> 
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('admin/vendor/jquery.selectbox-0.2.js')}}"></script>
<script src="{{asset('admin/vendor/retina-replace.min.js')}}"></script>
<script src="{{asset('admin/vendor/jquery.magnific-popup.min.js')}}"></script>
    <!-- Custom scripts for all pages-->
<script src="{{asset('admin/js/admin.js')}}"></script>
	<!-- Custom scripts for this page-->
{{-- <script src="{{asset('admin/js/admin-charts.js')}}"></script> --}}
	@yield('js')
</body>
</html>
