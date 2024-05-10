<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name') }}</title>
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
    </head>
    <body>
        @include('partials.ils-header')
        @include('partials.libspace-header')
        @yield('content')
        @include('partials.libspace-footer')
    </body>
</html>