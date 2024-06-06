@extends('layouts.landing')

@section('title')
    Facilities &sdot; 
@endsection

@section('content')
<main class="main">
  <!-- Facilities -->
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
              @if($learningSpace->slug == "collaboration-room") 
                <img src="/images/facilities/collaboration-room.jpg" alt="Collaboration Room" />
              @else
                <img src="/images/facilities/learning-commons.jpg" alt="Leaning Commons" />
              @endif
            </div>
            <div class="article-text">
              <div class="article-author text-muted">
                <span>Capacity: {{ $learningSpace->min_capacity }} - {{ $learningSpace->max_capacity }}</span>
              </div>
              <div class="article-title">
                <a href="{{ route('landing.facility', ['slug' => $learningSpace->slug]) }}">
                  <h3 class="font-weight-bold">{{ $learningSpace->name }}</h3>
                </a>
              </div>
              <div class="article-description text-muted">
                <p>
                  @if($learningSpace->slug == "collaboration-room") 
                    Amenities:<br>
                    1 Computer<br>
                    1 Smart TV<br>
                    1 Projector and white screen<br>
                    30 Chairs<br>
                    3 Tables
                  @else
                    Amenities:<br>
                    1 Computer<br>
                    1 Smart TV<br>
                    1 Projector and white screen<br>
                    8 Chairs<br>
                    2 Tables
                  @endif
                </p>
              </div>
            </div>
            <div class="article-footer text-center pb-3">
              <a class="button button-warning" href="{{ route('schedules.index', ['learningSpaceId' => $learningSpace->id]) }}">Reserve now</a><br>
              <a class="button-sm button-primary" href="{{ route('landing.facility', ['slug' => $learningSpace->slug]) }}">View details</a>
            </div>
          </a>
        </div>
        @endforeach
        <!-- <div class="article">
          <a href="?view=facility&id=2">
            <div class="article-image">
              <img src="/images/facilities/learning-common-1.jpg" alt="Leaning Commons" />
            </div>
            <div class="article-text">
              <div class="article-author text-muted">
                <span>Max Capacity: 6</span>
              </div>
              <div class="article-title">
                <a href="?view=facility&id=2">
                  <h3 class="font-weight-bold">Learning Commons</h3>
                </a>
              </div>
              <div class="article-description text-muted">
                <p>
                  Amenities:<br>
                  1 Computer<br>
                  1 Smart TV<br>
                  1 Projector and white screen<br>
                  8 Chairs<br>
                  2 Tables
                </p>
              </div>
            </div>
            <div class="article-footer text-center pb-3">
              <a class="button button-warning" href="{{ route('schedules.index', ['id' => '2']) }}">Reserve now</a><br>
              <a class="button-sm button-primary" href="{{ route('landing.facility', ['slug' => 'learning-commons']) }}">View details</a>
            </div>
          </a>
        </div> -->
      </div>
    </div>
  </section>
</main>
@endsection