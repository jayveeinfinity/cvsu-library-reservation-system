<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="x icon" type="img/png" href="/images/CvSU-logo-16x16.webp">
    <title>
      @yield('title') &sdot; {{ config('app.name') }}
    </title>
    <!-- Chart JS -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Sweet Alert 2 -->
    <link rel="stylesheet" href="{{asset('plugins/sweetalert2/sweetalert2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Chart JS -->
    <link rel="stylesheet" href="{{asset('plugins/chart.js/Chart.css')}}">
    <!-- Bootstrap Iconpicker CSS-->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-iconpicker/css/bootstrap-iconpicker.css')}}"/>
  </head>
  <body style="background-color: #f3f4f6;">
    @yield('main-content-header')
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('main-content')
    <!-- /.content -->
  </body>
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- Sweet Alert 2 -->
  <script src="{{asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
  <!-- Sweet Alert 2 -->
  <script src="{{asset('plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
  <!-- Chart JS -->
  <script src="{{asset('plugins/chart.js/Chart.js')}}"></script>
  <!-- Bootstrap Iconpicker JS -->
  <script src="{{asset('plugins/fontawesome-iconpicker/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
  @yield('script')
</html>