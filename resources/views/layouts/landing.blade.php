<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') {{ config('app.name') }}</title>
        <link rel="x icon" type="img/png" href="images/CvSU-logo-16x16.webp">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- ILS Utils -->
        <link rel="stylesheet" href="{{ asset('css/ils-utils.css') }}">
        <!-- ILS LibSpace -->
        <link rel="stylesheet" href="{{ asset('css/ils-libspace.css') }}">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Admin LTE style -->
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
        <style>
            @yield('style')
        </style>
    </head>
    <body>
        @include('partials.ils-header')
        @include('partials.libspace-header')
        @yield('content')
        @include('partials.libspace-footer')
    </body>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>