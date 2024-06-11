@extends('layouts.admin')

@section('title')
  Create amenities &sdot; 
@endsection

@section('main-content-header')
<div class="content-header" style="background-image: url('/images/landing/library.jpg'); background-size: cover; background-position: 100% 70%; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a class="badge badge-primary float-sm-left mb-3" href="{{ route('admin.amenities.index') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to amenities</a>
                <br><br><br><br>
                <h1 class="m-0 text-white" style="text-shadow: 4px 4px 6px #838383;"><i class="fas fa-home"></i> Amenities</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb px-3 elevation-1 bg-white float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.amenities.index') }}">Amenities</a></li>
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
                        <form class="px-3" data-form="amenityForm">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Type name..." data-input="name">
                                </div>
                                <div class="form-group col-6">
                                    <label>Icon</label>
                                    <br>
                                    <button class="btn btn-secondary iconpicker-btn" role="iconpicker" id="iconPickerBtn"></button>
                                </div>
                                <div class="form-group w-100">
                                    <button type="button" class="btn bg-gradient-success float-right" data-submit="createAmenity">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const nameInput = document.querySelector('[data-input="name"]');
    const createAmenityBtn = document.querySelector('[data-submit="createAmenity"]');

    let icon = null;

    createAmenityBtn.addEventListener("click", (e) => {
        e.preventDefault();
        var formData = new FormData();
        formData.append('name', nameInput.value);
        formData.append('icon', icon);
        formData.append('_token', "{{ csrf_token() }}");
        $.ajax({
            type: "POST",
            url: "{{ route('admin.amenities.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                Swal.fire({
                    icon: response.icon,
                    title: response.title,
                    text: response.message,
                    allowOutsideClick: false
                }).then((result) => {
                    if(result.isConfirmed) {
                        window.location.reload();
                    }
                });
            }
        });
    });
    
    $('#iconPickerBtn').iconpicker({
        }).on('change', function(e) {
            icon = e.icon;
    });
</script>
@endsection