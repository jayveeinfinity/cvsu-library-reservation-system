@extends('layouts.landing')

@section('title')
    Profile &sdot; 
@endsection

@section('style')
    .nav-link.active {
        background-color: #FF8008 !important;
    }
@endsection

@section('content')
<div class="container-fluid ils-gradient-warning-alt p-0 m-0" style="height: 300px;">
    <div style="height: 300px; background-image: url({{ asset('images/landing/library-orange.jpg') }}) ; background-size: cover; background-position: 100% 77%;"></div>
</div>
<div class="container-fluid">
    <div class="container p-3" style="margin-top: -300px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="text-white font-weight-bold">Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="bg-white px-3 py-0 breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{ $googleUserInfo->picture }}" alt="User profile picture" style="border: 3px solid #ff8008 !important;">
                                </div>
                                <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>
                                <!-- <p class="text-muted text-center">Computer Programmer I</p>                                <a href="#" class="btn btn-block btn-default disabled"><b>Edit profile</b></a> -->
                                <!-- <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b>
                                        <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b>
                                        <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b>
                                        <a class="float-right">13,287</a>
                                    </li>
                                </ul> -->
                                <hr>
                                <strong class="text-success"><i class="fas fa-venus-mars mr-1" aria-hidden="true"></i> Sex</strong>
                                <p class="text-muted">Male</p>
                                <hr>
                                <strong class="text-success"><i class="fas fa-map-marker-alt mr-1" aria-hidden="true"></i> Address</strong>
                                <p class="text-muted">Block 11 Lot 20 Villa Monteverde Subdivision, Mulawin, Tanza, Cavite</p>
                                <hr>
                                <strong class="text-success"><i class="fas fa-mobile-alt mr-1" aria-hidden="true"></i> Contact Number</strong>
                                <p class="text-muted">9959121524</p>
                                <hr>
                                <strong class="text-success"><i class="fas fa-at mr-1" aria-hidden="true"></i> Email</strong>
                                <p class="text-muted">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header ils-bg-green">
                                <h3 class="card-title text-white">University Information</h3>
                            </div>
                            <div class="card-body">
                                <strong class="text-success"><i class="fas fa-university mr-1" aria-hidden="true"></i> Campus</strong>
                                <p class="text-muted">Cavite State University - Don Severino Delas Alas Campus</p>
                                <hr>
                                
                                            <strong class="text-success"><i class="fas fa-id-card mr-1" aria-hidden="true"></i> Employee ID</strong>
                                            <p class="text-muted">5024</p>
                                            <hr>
                                            <strong class="text-success"><i class="fas fa-user mr-1" aria-hidden="true"></i> Position</strong>
                                            <p class="text-muted">Computer Programmer I</p>
                                        
                                                <hr>
                                                <strong class="text-success"><i class="fas fa-building mr-1" aria-hidden="true"></i> Office</strong>
                                                <p class="text-muted">Office of the Vice President for Academic Affairs</p>
                                                                                                            <!--
                                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                                <p class="text-muted">
                                    <span class="tag tag-danger">UI Design</span>
                                    <span class="tag tag-success">Coding</span>
                                    <span class="tag tag-info">Javascript</span>
                                    <span class="tag tag-warning">PHP</span>
                                    <span class="tag tag-primary">Node.js</span>
                                </p>
                                <hr>
                                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#reservations" data-toggle="tab">Reservations</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="reservations">
                                        <h5>My Reservations</h5>
                                        @if(!$myReservation)
                                            <p class="text-muted">No active reservations yet.</p>
                                        @else
                                        <div class="card">
                                            <div class="card-horizontal">
                                                @php
                                                    $status = "badge-primary";

                                                    switch($myReservation->status) {
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
                                                    $reservation_date = Carbon\Carbon::parse($myReservation->reservation_date);
                                                    $start_time = Carbon\Carbon::createFromTimestamp(strtotime(today()->format('Y-m-d') . $myReservation->start_time));
                                                    $end_time = Carbon\Carbon::createFromTimestamp(strtotime(today()->format('Y-m-d') . $myReservation->end_time));

                                                    $duration = $end_time->diff($start_time);
                                                    $image = $myReservation->learningSpace->slug == "collaboration-room" ? "collaboration-area" : "learning-common-1";
                                                @endphp
                                                <div class="img-square-wrapper">
                                                    <img class="" src="images/facilities/{{ $image }}.jpg" alt="Card image cap" style="height: 180px;">
                                                </div>
                                                <div class="card-body">
                                                <!-- <h3>{{ $controlNumber }} </h3> -->
                                                <h4 class="card-title">{{ $myReservation->learningSpace->name  }} <span class="badge badge-pill {{ $status }}">{{ Str::upper($myReservation->status) }}</span></h4>
                                                <p class="card-text mb-0"><span class="badge badge-pill badge-warning">Date</span> {{ $reservation_date->format('F d, Y') }} ({{$reservation_date->format('l')}})</p>
                                                <p class="card-text mb-0"><span class="badge badge-pill badge-warning">Time</span> {{ Carbon\Carbon::parse($myReservation->start_time)->format('h:i A') }} - {{ Carbon\Carbon::parse($myReservation->end_time)->format('h:i A') }} ({{ $duration->format('%h') }} hours)</p>
                                                <p class="card-text"><span class="badge badge-pill badge-warning">Participants</span> {{ $myReservation->no_of_guests}}</p>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">Date confirmed: {{ $reservation_date->format('F d, Y') }}</small>
                                            </div>
                                        </div>
                                        @endif
                                        <h5>Past Reservations</h5>
                                        @forelse($pastReservation as $reservation)
                                        <div class="card">
                                            <div class="card-horizontal">
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
                                                    $reservation_date = Carbon\Carbon::parse($reservation->reservation_date);
                                                    $start_time = Carbon\Carbon::createFromTimestamp(strtotime(today()->format('Y-m-d') . $reservation->start_time));
                                                    $end_time = Carbon\Carbon::createFromTimestamp(strtotime(today()->format('Y-m-d') . $reservation->end_time));

                                                    $duration = $end_time->diff($start_time);
                                                    $image = $reservation->learningSpace->slug == "collaboration-room" ? "collaboration-area" : "learning-common-1";
                                                @endphp
                                                <div class="img-square-wrapper">
                                                    <img src="images/facilities/{{ $image }}.jpg" alt="Card image cap" style="height: 180px;">
                                                </div>
                                                <div class="card-body">
                                                    <h4 class="card-title">{{ $reservation->learningSpace->name }} <span class="badge badge-pill {{ $status }}">{{ Str::upper($myReservation->status) }}</span></h4>
                                                    <p class="card-text mb-0"><span class="badge badge-pill badge-warning">Date</span>  {{ $reservation_date->format('F d, Y') }} ({{$reservation_date->format('l')}})</p>
                                                    <p class="card-text mb-0"><span class="badge badge-pill badge-warning">Time</span> {{ Carbon\Carbon::parse($myReservation->start_time)->format('h:i A') }} - {{ Carbon\Carbon::parse($myReservation->end_time)->format('h:i A') }} ({{ $duration->format('%h') }} hours)</p>
                                                    <p class="card-text"><span class="badge badge-pill badge-warning">Participants</span> {{ $myReservation->no_of_guests}}</p>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <small class="text-muted">Date booked: {{ $reservation->created_at->format('F d, Y') }}</small>
                                            </div>
                                        </div>
                                        @empty
                                            <p class="text-muted">No past reservations yet.</p>
                                        @endforelse
                                        <!-- <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="https://scontent.fmnl4-6.fna.fbcdn.net/v/t39.30808-6/260050783_2043737332468273_7925948207164743609_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=174925&_nc_eui2=AeH60MKhDxaRSA3os3qWSR8KZwSz_ZCzIO9nBLP9kLMg749Sd0pvf_aMXKCVS-RM0sc5q2PRX3Bi8czOgs45tF5b&_nc_ohc=9ibeWJjfkWAAX8jwZ6_&_nc_ht=scontent.fmnl4-6.fna&oh=00_AT9LiW6caVP0rJuyuHbnaUfPa917f4lH4VMORlx7M_nn0Q&oe=6314E8EE" alt="user image">
                                                <span class="username">
                                                    <a href="#">Ingrid Christianne Dones Garcia</a>
                                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Shared publicly - 7:30 PM today</span>
                                            </div>
                                            <p> I'm watching The Walking Dead Season 4 Episode 13 :)</p>
                                            <p>
                                                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                                    </a>
                                                </span>
                                            </p>
                                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                        </div>
                                        <div class="post clearfix">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                                <span class="username">
                                                    <a href="#">Sarah Ross</a>
                                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Sent you a message - 3 days ago</span>
                                            </div>
                                            <p>Lorem ipsum represents a long-held tradition for designers,
                                                typographers and the like. Some people hate it and argue for
                                                its demise, but others ignore the hate as they create awesome
                                                tools to help create filler text for everyone from bacon lovers
                                                to Charlie Sheen fans.</p>
                                            <form class="form-horizontal">
                                                <div class="input-group input-group-sm mb-0">
                                                    <input class="form-control form-control-sm" placeholder="Response">
                                                    <div class="input-group-append">
                                                        <button type="submit" class="btn btn-danger">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="post">
                                            <div class="user-block">
                                                <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                                                <span class="username">
                                                    <a href="#">Adam Jones</a>
                                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                                </span>
                                                <span class="description">Posted 5 photos - 5 days ago</span>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                                            <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                                            <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                                <span class="float-right">
                                                    <a href="#" class="link-black text-sm">
                                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                                    </a>
                                                </span>
                                            </p>
                                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                        </div> -->
                                    </div>
                                    <div class="tab-pane" id="activity">
                                        <p class="text-muted"><i class="fas fa-exclamation-triangle text-warning" aria-hidden="true"></i> Ongoing development</p>
                                        <!-- <div class="timeline timeline-inverse">
                                            <div class="time-label">
                                                <span class="bg-danger">10 Feb. 2014</span>
                                            </div>
                                            <div>
                                                <i class="fas fa-envelope bg-primary"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                                                    <div class="timeline-body">Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle quora plaxo ideeli hulu weebly balihoo...
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-user bg-info"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                                                <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="fas fa-comments bg-warning"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>
                                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                                <div class="timeline-body">Take me to your leader! Switzerland is small and neutral! We are more like Germany, ambitious and misunderstood!</div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="time-label">
                                            <span class="bg-success">
                                                3 Jan. 2014
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-camera bg-purple"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> 2 days ago</span>
                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                                <div class="timeline-body">
                                                    <img src="https://placehold.jp/150x100.png" alt="...">
                                                    <img src="https://placehold.jp/150x100.png" alt="...">
                                                    <img src="https://placehold.jp/150x100.png" alt="...">
                                                    <img src="https://placehold.jp/150x100.png" alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div> -->
                                    </div>
                                    <div class="tab-pane" id="settings">
                                        <p class="text-muted"><i class="fas fa-exclamation-triangle text-warning" aria-hidden="true"></i> Ongoing development</p>
                                        <!-- <form class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Name</  label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-danger">Submit</button>
                                                </div>
                                            </div>
                                        </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection