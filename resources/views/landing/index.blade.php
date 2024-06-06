@extends('layouts.landing')

@section('content')
<main class="main">
  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-image"></div>
      <div class="hero-text">
        <h1>Looking for new learning spaces?</h1>
        <p>
          Social, interactive, and collaborative learning spaces applicable to your academic needs.
        </p>
        <a href="{{ route('schedules.index') }}" class="button button-warning">Reserve a space</a>
      </div>
    </div>
  </section>
  <!-- Features Section -->
  <section class="features">
    <div class="container">
      <div class="section-heading">
        <h2>What is <span class="text-warning" style="font-family: 'Mouse Memoirs', sans-serif !important;">Reservation System</span>?</h2>
        <p>
        Reservation System is an online reservation system of Ladislao N. Diwa Memorial Library designed and programmed for the reservation of the different learning spaces used for the different types of academic group activities.
        </p>
      </div>
      <div class="section-content">
        <div class="features-grid">
          <div class="feature">
            <div class="feature-icon">
              <img src="images/icons/free-to-use.png" alt="Free to use icon" />
            </div>
            <div class="feature-title">
              <h3 class="text-uppercase">Free to use</h3>
            </div>
            <div class="feature-description">
              <p>
                Our modern web and mobile applications allow you to keep
                track of your finances wherever you are in the world.
              </p>
            </div>
          </div>
          <div class="feature">
            <div class="feature-icon">
              <img src="images/icons/aircondition.png" alt="Aircondition Icon" />
            </div>
            <div class="feature-title">
              <h3 class="text-uppercase">Airconditioned</h3>
            </div>
            <div class="feature-description">
              <p>
                See exactly where your money goes each month. Receive
                notifications when you’re close to hitting your limits.
              </p>
            </div>
          </div>
          <div class="feature">
            <div class="feature-icon">
              <img src="images/icons/collaboration.png" alt="Collaboration Icon" />
            </div>
            <div class="feature-title">
              <h3 class="text-uppercase">Collaborative</h3>
            </div>
            <div class="feature-description">
              <p>
                We don’t do branches. Open your account in minutes online
                and start taking control of your finances right away.
              </p>
            </div>
          </div>
          <div class="feature">
            <div class="feature-icon">
              <img src="images/icons/wifi.png" alt="Wifi Icon" />
            </div>
            <div class="feature-title">
              <h3 class="text-uppercase">Internet Access</h3>
            </div>
            <div class="feature-description">
              <p>
                Manage your savings, investments, pension, and much more
                from one account. Tracking your money has never been easier.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Latest Articels -->
  <section class="articles py-5">
    <div class="container">
      <div class="section-heading">
        <h2>Facilities</h2>
      </div>
      <div class="articles-grid">
        @foreach($learningSpaces as $learningSpace)
        <div class="article">
          <a href="{{ route('landing.facility', ['slug' => $learningSpace->slug]) }}">
            <div class="article-image">
              @if($learningSpace->slug == 'collaboration-room')
                <img src="images/facilities/collaboration-room.jpg" alt="Collaboration Room" />
              @else
                <img src="images/facilities/learning-commons.jpg" alt="Learning Commons" />
              @endif
            </div>
            <div class="article-text">
              <div class="article-author text-muted">
                <span>Max Capacity: {{ $learningSpace->max_capacity }}</span>
              </div>
              <div class="article-title">
                <a href="{{ route('landing.facility', ['slug' => $learningSpace->slug]) }}">
                  <h3 class="font-weight-bold">{{ $learningSpace->name }}</h3>
                </a>
              </div>
              <div class="article-description text-muted">
                <p>
                  @if($learningSpace->slug == 'collaboration-room')
                    Amenities:<br>
                    1 Computer<br>
                    1 Smart TV<br>
                    1 Projector and white screen<br>
                    30 Chairs<br>
                    3 Tables<br>
                  @else
                    Amenities:<br>
                    1 Computer<br>
                    1 Smart TV<br>
                    1 Projector and white screen<br>
                    8 Chairs<br>
                    2 Tables<br>
                  @endif
                </p>
              </div>
            </div>
            <div class="article-footer text-center pb-3">
              <a class="button button-warning" href="{{ route('schedules.index', ['id' => $learningSpace->id]) }}">Reserve now</a><br>
              <a class="button-sm button-primary" href="{{ route('landing.facility', ['slug' => $learningSpace->slug]) }}">View details</a>
            </div>
          </a> 
        </div>
        @endforeach
      </div>
    </div>
  </section>
</main>
@endsection