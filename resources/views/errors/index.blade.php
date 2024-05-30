@extends('layouts.landing')

@section('title')
    Page not found &sdot; 
@endsection

@section('content')
<section class="content text-center pb-5 bg-white">
    <img src="/images/illustrations/{{ $data['code'] }}.jpg">
    <br>
    <a href="./">Return to landing page</a>
</section>
@endsection