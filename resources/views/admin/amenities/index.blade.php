@extends('layouts.admin')

@section('title')
  Amenities &sdot; 
@endsection

@section('main-content-header')
<div class="content-header" style="background-image: url('/images/landing/library.jpg'); background-size: cover; background-position: 100% 70%; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a class="badge badge-primary float-sm-left mb-3" href="{{ route('admin.dashboard') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to admin dashboard</a>
                <br><br><br><br>
                <h1 class="m-0 text-white" style="text-shadow: 4px 4px 6px #838383;"><i class="fas fa-home"></i> Amenities</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb px-3 elevation-1 bg-white float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Amenities</li>
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
            <div class="col-6">
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <h3 class="w-100 card-title">Amenities ({{ $amenitiesCount }})</h3>
                        <div class="w-100 text-right">
                            <a class="btn bg-gradient-success btn-sm" href="{{ route('admin.amenities.create') }}"><i class="fas fa-plus"></i> Create amenity</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-12" style="position: relative;">
                                    <table class="table table-bordered table-striped">
                                        @if(!$amenities->isEmpty())
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        @endif
                                        <tbody>
                                            @forelse($amenities as $amenity)
                                                <tr>
                                                    <td><i class="{{ $amenity->icon }}"></i> {{ $amenity->name }}</td>
                                                    <td>
                                                        <a class="btn mr-2 mb-2 bg-gradient-danger btn-sm" href="{{ route('admin.amenities.destroy', ['id' => $amenity->id]) }}"><i class="fas fa-trash"></i> Delete</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <p>No amenities yet.</p>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @if(!$amenities->isEmpty())
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info">Showing 1 to 1 of {{ $amenities->count() }} {{ Str::plural('entry', $amenities->count()) }}</div>
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
<div class="modal fade" id="amenityModal" tabindex="-1" aria-labelledby="amenityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="amenityModalLabel">Create an amenity</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-left"></i> Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection