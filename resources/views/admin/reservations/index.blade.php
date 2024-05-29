@extends('layouts.admin')

@section('title')
  Reservations &sdot; 
@endsection

@section('main-content-header')
<div class="content-header" style="background-image: url('/images/landing/library.jpg'); background-size: cover; background-position: 100% 70%; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a class="badge badge-primary float-sm-left mb-3" href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to admin dashboard</a>
                <br><br><br><br>
                <h1 class="m-0 text-white" style="text-shadow: 4px 4px 6px #838383;"><i class="fas fa-list"></i> Reservations</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb px-3 elevation-1 bg-white float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Reservations</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <h3 class="card-title">Reservations</h3>
                        <!-- <div class="w-100 text-right">
                            <a class="btn bg-gradient-success btn-sm" href="?view=thesesmanagementsystem&amp;action=create"><i class="fas fa-plus"></i> Create reservation</a>
                        </div> -->
                        <!-- <div class="btn-group btn-group-toggle float-right border border-secondary rounded mr-3">
                            <label class="btn btn-sm btn-light bg-green">
                                <a href="javascript:void(0)">Default</a>
                            </label>
                            <label class="btn btn-sm btn-light">
                                <a href="?parent=catalog&child=ebooks&action=browse&view=expanded">Expanded</a>
                            </label>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <!-- <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_length">
                                        <label>Show <select class="custom-select custom-select-sm form-control form-control-sm" data-ebook="rows">
                                            <option value="20" selected="">20</option><option value="50">50</option><option value="100">100</option><option value="200">200</option><option value="500">500</option>                                            </select> entries</label>
                                        <div class="ils-table-filters-divider"></div>
                                        <label>Category <select class="custom-select custom-select-sm form-control form-control-sm" data-ebook="category">
                                            <option value="0">All</option>
                                            <option value="1">Accountancy</option><option value="2">Agriculture</option><option value="3">Architecture</option><option value="4">Biology</option><option value="5">Business Management, Marketing</option><option value="6">Computer, Technology</option><option value="7">Criminology, Security</option><option value="51">Development Management</option><option value="8">Economics</option><option value="9">Education</option><option value="10">Engineering</option><option value="11">Environmental Science</option><option value="12">Food</option><option value="52">Gender and Development (GAD)</option><option value="13">Hotel and Restaurant Management (HRM), Tourism</option><option value="14">International Studies</option><option value="15">Journalism, Mass Communication</option><option value="16">Mathematics</option><option value="17">Medicine, Nursing, Medical Technology</option><option value="18">Office Administration</option><option value="25">Others</option><option value="19">Physical Education, Sports</option><option value="20">Political Science</option><option value="21">Psychology</option><option value="22">Science</option><option value="53">Social Science</option><option value="23">Social Work</option><option value="24">Veterinary Medicine</option>                                            </select></label>
                                        <div class="ils-table-filters-divider"></div>
                                        <label>Order by <select class="custom-select custom-select-sm form-control form-control-sm" data-ebook="orderBy">
                                            <option value="latest">Latest</option><option value="oldest">Oldest</option><option value="accessionasc">Accession Number Ascending</option><option value="accessiondesc">Accession Number Descending</option><option value="titleasc">Title Ascending</option><option value="titledesc">Title Descending</option><option value="yearasc">Copyright Year Ascending</option><option value="yeardesc">Copyright Year Descending</option>                                            </select></label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_filter">
                                        <input type="text" class="form-control form-control-sm" placeholder="Search keyword..." value="" data-ebook="search">
                                        <button class="btn btn-sm btn-primary" data-ebook="searchSubmit">Search</button>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row px-2 pt-0 pb-3">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a type="button" class="{{ $date_type == 'All' ? 'btn btn-primary' : 'btn btn-outlined btn-default' }}" href="{{ route('admin.reservations.index', ['date_type' => 'All']) }}">All</a>
                                    <a type="button" class="{{ $date_type == 'Today' ? 'btn btn-primary' : 'btn btn-outlined btn-default' }}" href="{{ route('admin.reservations.index', ['date_type' => 'Today']) }}">Today</a>
                                    <a type="button" class="{{ $date_type == 'Pending' ? 'btn btn-primary' : 'btn btn-outlined btn-default' }}" href="{{ route('admin.reservations.index', ['status' => 'Pending']) }}">Pending</a>
                                    <a type="button" class="{{ $date_type == 'Recent' ? 'btn btn-primary' : 'btn btn-outlined btn-default' }}" href="{{ route('admin.reservations.index', ['date_type' => 'Recent']) }}">Recent</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12" style="position: relative;">
                                    <table class="table table-bordered table-striped">
                                        @if(!$reservations->isEmpty())
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Learning Space</th>
                                                <th>Reservee Name</th>
                                                <th>Status</th>
                                                <th>Processed By</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            @forelse($reservations as $reservation)
                                                <tr>
                                                    <td style="width: 10px;">{{ $reservation->id }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('F d, Y') }}</td>
                                                    <td><span class="badge badge-pill badge-primary">{{ \Carbon\Carbon::parse($reservation->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($reservation->end_time)->format('g:i A') }}</span></td>
                                                    <td>{{ $reservation->learningSpace->name }}</td>
                                                    <td>{{ $reservation->user->name }}</td>
                                                    <td>
                                                        @switch($reservation->status)
                                                            @case('pending')
                                                                <span class="badge badge-pill badge-primary">Pending</span>
                                                                @break

                                                            @case('confirmed')
                                                            <span class="badge badge-pill badge-success">Confirmed</span>
                                                                @break

                                                            @case('rejected')
                                                                <span class="badge badge-pill badge-danger">Rejected</span>
                                                                @break

                                                            @default
                                                                
                                                        @endswitch
                                                    </td>
                                                    <td>{{ $reservation->processedBy->name ?? NULL }}</td>
                                                    <td>
                                                        <!-- <a class="btn mr-2 mb-2 bg-gradient-success btn-sm" style="width: 36px;" href="?parent=catalog&amp;child=ebooks&amp;action=read&amp;id=3079" data-id="3079"><i class="fas fa-eye"></i></a>
                                                        <a class="btn mr-2 mb-2 bg-gradient-warning text-white btn-sm" style="width: 36px;" href="https://link.springer.com/book/10.1007/978-3-030-57562-5 " target="_blank"><i class="fas fa-link"></i></a> -->
                                                        <!-- <a class="btn mr-2 mb-2 bg-gradient-primary btn-sm"  href="#"><i class="fas fa-edit"></i> Edit</a></td> -->
                                                        <a class="btn mr-2 mb-2 bg-gradient-success btn-sm"  href="javascript:void(0)" data-submit="approveReservation" data-id="{{ $reservation->id }}"><i class="fas fa-check"></i> Approve</a>
                                                        <a class="btn mr-2 mb-2 bg-gradient-danger btn-sm"  href="javascript:void(0)" data-submit="rejectReservation" data-id="{{ $reservation->id }}"><i class="fas fa-ban"></i> Reject</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <p>No reservations for today.</p>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if(!$reservations->isEmpty())
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info">Showing 1 to 1 of {{ $reservations->count() }} {{ Str::plural('entry', $reservations->count()) }}</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_numbers">
                                            <ul class="pagination"></ul>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="reservationModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="reservationModalLabel">Reject reservation</h5>
            <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> -->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <form class="px-3" data-form="rejectionForm">
                            <div class="form-group">
                                <label for="reasonOfRejection">Reason of rejection</label>
                                <textarea class="form-control" placeholder="Type reason of rejection..." style="height: 100px;" data-textarea="reason" required></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <a type="button" class="button-sm button-secondary" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Cancel</a>
            <button type="button" class="button-sm button-warning border-0" data-submit="confirmRejectReservation" disabled>Confirm reject</button>
        </div>
        </div>
</div>
</div>
<script>
    let id = null;

    document.addEventListener("click", (e) => {
        e = e || window.event;
        var target = e.target || e.srcElement;
        switch(target.dataset.submit) {
            case "approveReservation":
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    type: "POST",
                    url: "reservations/" + target.dataset.id + "/approve",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        willClose: () => {
                        $(document).ready(function() {
                            $('#reservationModal').modal('hide');
                            window.location = "{{ route('admin.reservations.index') }}";
                        });
                        }
                    });
                    }
                });
                break;
            case "rejectReservation":
                $(document).ready(function() {
                    $('#reservationModal').modal('show');
                });
                id = target.dataset.id;
                break;
            case "confirmRejectReservation":
                var formData = new FormData();
                formData.append('reason', reasonTextArea.value);
                formData.append('_token', "{{ csrf_token() }}");
                $.ajax({
                    type: "POST",
                    url: "reservations/" + id + "/reject",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        willClose: () => {
                        $(document).ready(function() {
                            $('#reservationModal').modal('hide');
                            window.location = "{{ route('admin.reservations.index') }}";
                        });
                        }
                    });
                    }
                });
                break;
        }
    });

    const rejectionForm = document.querySelector('[data-form="rejectionForm"]');
    const rejectButton = document.querySelector('[data-submit="confirmRejectReservation"]');
    const reasonTextArea = document.querySelector('[data-textarea="reason"]');

    rejectionForm.addEventListener('input', function () {
        rejectButton.disabled = !reasonTextArea.value;
    });
</script>
@endsection