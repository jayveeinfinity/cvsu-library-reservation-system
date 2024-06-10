@extends('layouts.admin')

@section('title')
  Create amenities &sdot; 
@endsection

@section('main-content-header')
<div class="content-header" style="background-image: url('/images/landing/library.jpg'); background-size: cover; background-position: 100% 70%; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a class="badge badge-primary float-sm-left mb-3" href="{{ route('admin.learningspaces.index') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to learning spaces</a>
                <br><br><br><br>
                <h1 class="m-0 text-white" style="text-shadow: 4px 4px 6px #838383;"><i class="fas fa-home"></i> Amenities</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb px-3 elevation-1 bg-white float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.learningspaces.index') }}">Amenities</a></li>
                    <li class="breadcrumb-item active">Create</li>
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
                        <h3 class="w-100 card-title">Create amenities</h3>
                    </div>
                    <div class="card-body pb-0">
                        <form data-form="learningSpace">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Type name...">
                                </div>
                                <div class="form-group col-6">
                                    <label>Icon</label>
                                    <br>
                                    <button class="btn btn-secondary iconpicker-btn" role="iconpicker" id="iconPickerBtnFacilities"></button>
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <button class="btn bg-gradient-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const form = document.querySelector('[data-form="learningSpace"]');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        console.log(e);
    });
</script>
@endsection