@extends('layouts.landing')

@section('content')
<main class="main">
  <!-- Facilities -->
  <section class="articles py-5">
    <div class="container">
      <a href="{{ route('schedules.index', ['id' => $learningSpace->id]) }}" class="button button-warning float-right d-lg-inline-block d-md-none d-sm-none hide-for-mobile">Reserve {{ $learningSpace->name }}</a>
      <div class="section-heading">
        <h2 class="font-weight-bold">{{ $learningSpace->name }}</h2>
        <span class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $learningSpace->location }}</span>
        <a href="{{ route('schedules.index', ['id' => $learningSpace->id]) }}" class="mt-4 button button-warning text-center d-lg-none d-md-block d-sm-block hide-for-desktop">Reserve {{ $learningSpace->name }}</a>
      </div>
      <hr>
      <section class="section-details pt-3">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <h4 class="px-2">Description</h4>
            <p class="px-2 text-muted"><span class="badge badge-primary">Recommended</span> {{ $learningSpace->description }}</p>
            <h4 class="px-2">Capacity</h4>
            <ul class="ml-3 ils-list-style-none">
              <li class="text-muted"><i class="fas fa-users m-2"></i> {{ $learningSpace->min_capacity }} - {{ $learningSpace->max_capacity }}</li>
            </ul>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12" style="border-left: 1px solid rgba(0,0,0,.1)">
            <h4 class="px-2">Amenities</h4>
            <ul class="ml-3 ils-list-style-none">
              <li class="text-muted"><i class="fas fa-wifi m-2"></i> WiFi</li>
              <li class="text-muted"><i class="fas fa-ethernet m-2"></i> Wired Ethernet</li>
              <li class="text-muted"><i class="far fa-snowflake m-2"></i> Air condition</li>
              <li class="text-muted"><i class="fas fa-chair m-2"></i> Chairs</li>
              <li class="text-muted"><i class="fas fa-table m-2"></i> Tables</li>
              <li class="text-muted"><i class="fas fa-desktop m-2"></i> Computer</li>
              <li class="text-muted"><i class="fas fa-tv m-2"></i> Smart TV with movable stand</li>
              <li class="text-muted"><i class="fas fa-tv m-2"></i> Projector with white screen</li>
            </ul>
          </div>
        </div>
      </section>
      <hr>
      <section class="section-gallery pt-3">
        <h4 class="px-2">Gallery</h4>
        <div class="tz-gallery">
          <div class="row">
            <div class="col-sm-12 col-md-4">
                <a class="lightbox" href="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/bridge.jpg">
                    <img src="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/bridge.jpg" alt="Bridge">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/park.jpg">
                    <img src="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/park.jpg" alt="Park">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/tunnel.jpg">
                    <img src="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/tunnel.jpg" alt="Tunnel">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/traffic.jpg">
                    <img src="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/traffic.jpg" alt="Traffic">
                </a>
            </div>
            <div class="col-sm-6 col-md-4">
                <a class="lightbox" href="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/rails.jpg">
                    <img src="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/rails.jpg" alt="Coast">
                </a>
            </div> 
            <div class="col-sm-12 col-md-4">
                <a class="lightbox" href="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/coast.jpg">
                    <img src="https://raw.githubusercontent.com/LeshikJanz/libraries/master/Related%20images/Bootstrap%20example/coast.jpg" alt="Rails">
                </a>
            </div>
          </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
        <script>
            baguetteBox.run('.tz-gallery');
        </script>
      </section>
    </div>
  </section>
</main>
@endsection