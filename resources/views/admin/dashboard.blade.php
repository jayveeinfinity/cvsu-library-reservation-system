@extends('layouts.admin')

@section('title')
  Dashboard &sdot; 
@endsection

@section('main-content-header')
<div class="content-header" style="background-image: url('/images/landing/library.jpg'); background-size: cover; background-position: 100% 70%; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <!-- <a class="badge badge-primary float-sm-left mb-3" href="?view=home"><i class="fas fa-arrow-alt-circle-left"></i> Back to home</a> -->
                <br><br><br><br>
                <h1 class="m-0 text-white" style="text-shadow: 4px 4px 6px #838383;"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb px-3 elevation-1 bg-white float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main-content')
<div class="content">
  <div class="container-fluid">
    <div class="row pt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>{{ $usersCount }}</h3>
                    <p>Total users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    View records <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $learningSpaceCount }}</h3>
                    <p>Total learning spaces</p>
                </div>
                <div class="icon">
                    <i class="fas fa-home"></i>
                </div>
                <a href="{{ route('admin.learningspaces.index') }}" class="small-box-footer">
                    View records <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{ $reservationCount }}</h3>
                    <p>Total reservations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{ route('admin.reservations.index', ['date_type' => 'All']) }}" class="small-box-footer">
                    View records <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{ $rejectedReservation }}</h3>
                    <p>Total cancelled reservations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ban"></i>
                </div>
                <a href="{{ route('admin.reservations.index', ['status' => 'rejected']) }}" class="small-box-footer">
                    View records <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header card-success card-outline">
                    <h3 class="card-title"><i class="fas fa-check-circle"></i> Today's reservations</h3>
                </div>
                <div class="card-body p-2">
                    @if($reservationsToday->count() <= 0)
                    <p class="px-3 text-muted">No reservations today.</p>
                    @endif
                    <ul class="products-list product-list-in-card px-3">
                        @forelse($reservationsToday->get() as $reservation)
                            @php
                                $status = "badge-primary";

                                switch($reservation->status) {
                                    case "pending":
                                        $status = "badge-primary";
                                        break;
                                    case "confirmed":
                                        $status = "badge-success";
                                        break;
                                    case "rejected":
                                        $status = "badge-danger";
                                        break;
                                }
                            @endphp
                            <li class="pb-3">
                                <span class="badge badge-pill {{ $status }}">{{ Str::upper($reservation->status) }}</span>
                                {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('F d, Y') }} - {{ $reservation->learningSpace->name }}
                                ({{ \Carbon\Carbon::parse($reservation->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($reservation->end_time)->format('g:i A') }})
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header card-primary card-outline">
                    <h3 class="card-title"><i class="fas fa-calendar-check"></i> Pending reservations</h3>
                </div>
                <div class="card-body p-2">
                  @if($reservationsPending->count() <= 0)
                  <p class="px-3 text-muted">No pending reservations.</p>
                  @endif
                  <ul class="products-list product-list-in-card px-3">
                    @forelse($reservationsPending->get() as $reservation)
                        @php
                            $status = "badge-primary";

                            switch($reservation->status) {
                                case "pending":
                                    $status = "badge-primary";
                                    break;
                                case "confirmed":
                                    $status = "badge-success";
                                    break;
                                case "rejected":
                                    $status = "badge-danger";
                                    break;
                            }
                        @endphp
                        <li class="pb-3">
                            <span class="badge badge-pill {{ $status }}">{{ Str::upper($reservation->status) }}</span>
                            {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('F d, Y') }} - {{ $reservation->learningSpace->name }}
                            ({{ \Carbon\Carbon::parse($reservation->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($reservation->end_time)->format('g:i A') }})
                        </li>
                    @endforeach
                  </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header card-warning card-outline">
                    <h3 class="card-title"><i class="fas fa-history"></i> Recent reservations</h3>
                </div>
                <div class="card-body p-2">
                    @if($reservationsRecent->count() <= 0)
                    <p class="px-3 text-muted">No recent reservations.</p>
                    @endif
                    <ul class="products-list product-list-in-card px-3">
                        @forelse($reservationsRecent->get() as $reservation)
                            @php
                                $status = "badge-primary";

                                switch($reservation->status) {
                                    case "pending":
                                        $status = "badge-primary";
                                        break;
                                    case "confirmed":
                                        $status = "badge-success";
                                        break;
                                    case "rejected":
                                        $status = "badge-danger";
                                        break;
                                }
                            @endphp
                            <li class="pb-3">
                                <span class="badge badge-pill {{ $status }}">{{ Str::upper($reservation->status) }}</span>
                                {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('F d, Y') }} - {{ $reservation->learningSpace->name }}
                                ({{ \Carbon\Carbon::parse($reservation->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($reservation->end_time)->format('g:i A') }})
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection