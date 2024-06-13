@extends('layouts.admin')

@section('title')
  Create learning spaces &sdot; 
@endsection

@section('main-content-header')
<style>
    .product-image-thumb:hover {
        opacity: 1 !important;
    }
    .product-image-thumb:hover img {
        cursor: pointer !important;
        opacity: 0.7 !important;
    }
</style>
<div class="content-header" style="background-image: url('/images/landing/library.jpg'); background-size: cover; background-position: 100% 70%; background-repeat: no-repeat;">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <a class="badge badge-primary float-sm-left mb-3" href="{{ route('admin.learningspaces.index') }}"><i class="fas fa-arrow-alt-circle-left"></i> Back to learning spaces</a>
                <br><br><br><br>
                <h1 class="m-0 text-white" style="text-shadow: 4px 4px 6px #838383;"><i class="fas fa-building"></i> Learning Spaces</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb px-3 elevation-1 bg-white float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.learningspaces.index') }}">Learning Spaces</a></li>
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
                        <h3 class="w-100 card-title">Create learning space</h3>
                    </div>
                    <div class="card-body pb-0">
                        <form data-form="learningSpace">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" data-input="name" placeholder="Type name..." value="{{ $learningSpace->name ?? NULL }}" required>
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" class="form-control" data-input="location" placeholder="Type location..." value="{{ $learningSpace->location ?? NULL }}" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" data-textarea="description" placeholder="Type description..." rows="3" required>{{ $learningSpace->description ?? NULL }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Minimum capacity</label>
                                    <input type="number" class="form-control" data-input="minCapacity" placeholder="Type minimum capacity..." min="1" max="30" value="{{ $learningSpace->min_capacity ?? NULL }}" required>
                                </div>
                                <div class="form-group col-6">
                                    <label>Maximum capacity</label>
                                    <input type="number" class="form-control" data-input="maxCapacity" placeholder="Type maximum capacity..." min="1" max="30" value="{{ $learningSpace->max_capacity ?? NULL }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <h6 class="font-weight-bold">Amenities</h6>
                                @foreach($amenities as $amenity)
                                    @php
                                        $isChecked = '';
                                    @endphp
                                    @if($myAmenities)
                                        @foreach($myAmenities as $learningSpaceAmenity)
                                            @if($learningSpaceAmenity->amenities->id == $amenity->id)
                                                @php
                                                    $isChecked = 'checked';
                                                    break;
                                                @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="{{ $amenity->id }}" {{ $isChecked }}>
                                        <label class="form-check-label" for="amenity-{{ $amenity->id }}"> <i class="{{ $amenity->icon }}"></i> {{ $amenity->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group float-right">
                                <button class="btn bg-gradient-success" data-submit="createLearningSpace">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <h3 class="w-100 card-title">Gallery</h3>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <div class="col-12 product-image-thumbs">
                            @if($learningSpace)
                                @foreach($learningSpace->images as $image)
                                <div class="product-image-thumb d-flex flex-column">
                                    <img src="/storage/images/facilities/{{ $image->filename }}" alt="Product Image" style="object-fit: cover; height: 100%; width: 100px;">
                                    @if(!is_null($learningSpace->coverImage))
                                        @if($image->id != $learningSpace->coverImage->id)
                                            <button class="btn btn-xs btn-block btn-primary mt-2" data-click="setCoverImage" data-id="{{ $image->id }}" data-learningSpaceId="{{ $learningSpace->id }}">Set as cover</button>
                                            <button class="btn btn-xs btn-block btn-danger mt-1" data-click="removeImage" data-id="{{ $image->id }}">Remove</button>
                                        @endif
                                    @else
                                        <button class="btn btn-xs btn-block btn-primary mt-2" data-click="setCoverImage" data-id="{{ $image->id }}" data-learningSpaceId="{{ $learningSpace->id }}">Set as cover</button>
                                        <button class="btn btn-xs btn-block btn-danger mt-1" data-click="removeImage" data-id="{{ $image->id }}">Remove</button>
                                    @endif
                                </div>
                                @endforeach
                                @if(count($learningSpace->images) < 6)
                                    <div class="product-image-thumb pb-0">
                                        <img src="/storage/images/facilities/placeholder.png" alt="Product Image" width="100" data-click="addImage">
                                    </div>
                                @endif
                            @else
                                <div class="product-image-thumb pb-0">
                                    <img src="/storage/images/facilities/placeholder.png" alt="Product Image" width="100" data-click="addImage">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const form = document.querySelector('[data-form="learningSpace"]');
    const fileImageBtn = document.querySelector('[data-click="addImage"]');

    let fileImageSrc = null;

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        console.log(e);
    });

    if(fileImageBtn) {
        fileImageBtn.addEventListener("click", (e) => {
            (async () => {
                const { value: file } = await Swal.fire({
                    title: '<i class="fas fa-images"></i> Select file image',
                    input: 'file',
                    inputAttributes: {
                        'accept': 'image/*',
                        'aria-label': 'Upload image to gallery'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Submit'
                })
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        Swal.fire({
                            text: 'Are you sure you want to use this image?',
                            imageUrl: e.target.result,
                            imageWidth: 285,
                            imageHeight: 285,
                            imageAlt: 'The uploaded picture',
                            showCancelButton: true,
                            confirmButtonText: 'Use image'
                        }).then((result) => {
                            if(result.isConfirmed) {
                                fileImageSrc = e.target.result;
                                var formData = new FormData();
                                formData.append('learning_space_id', "{{ $learningSpace->id ?? null }}");
                                formData.append('image', fileImageSrc);
                                formData.append('_token', "{{ csrf_token() }}");
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('admin.images.upload') }}",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        console.log(response);
                                        Swal.fire({
                                            icon: "success",
                                            title: "Uploaded!",
                                            text: "Successfully uploded.",
                                            allowOutsideClick: false
                                        }).then((result) => {
                                            if(result.isConfirmed) {
                                                window.location.reload();
                                            }
                                        });
                                    }
                                });
                            };
                        });
                    }
                    reader.readAsDataURL(file);
                }
            })();
        });
    }

    document.addEventListener("click", (e) => {
        e = e || window.event;
        var target = e.target || e.srcElement;
        let id = target.dataset.id ?? null;
        let learningspaceid = target.dataset.learningspaceid ?? null;

        switch(target.dataset.click) {
            case "removeImage":
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if(result.isConfirmed) {
                        var formData = new FormData();
                        formData.append('id', id);
                        formData.append('_token', "{{ csrf_token() }}");
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.images.destroy') }}",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                console.log(response);
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: "Image has been deleted.",
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                        });
                    };
                });
                break;
            case "setCoverImage":
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: "This will set this image as new cover.",
                    showCancelButton: true,
                    confirmButtonColor: "#007bff",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Set as cover!"
                }).then((result) => {
                    if(result.isConfirmed) {
                        var formData = new FormData();
                        formData.append('id', id);
                        formData.append('learningspaceid', learningspaceid);
                        formData.append('_token', "{{ csrf_token() }}");
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.learningspaces.setCover') }}",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                console.log(response);
                                Swal.fire({
                                    icon: "success",
                                    title: "Saved!",
                                    text: "Successfully set new cover.",
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if(result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                        });
                    };
                });
                break;
        }
    });

    const learningSpaceForm = document.querySelector('[data-form="learningSpace"]');
    const nameInput = document.querySelector('[data-input="name"]');
    const locationInput = document.querySelector('[data-input="location"]');
    const descriptionTextarea = document.querySelector('[data-textarea="description"]');
    const minCapacityInput = document.querySelector('[data-input="minCapacity"]');
    const maxCapacityInput = document.querySelector('[data-input="maxCapacity"]');
    const amenities = document.querySelectorAll('.form-check-input');
    const createLearningSpaceBtn = document.querySelector('[data-submit="createLearningSpace"]');

    createLearningSpaceBtn.addEventListener("click", (e) => {
        e.preventDefault()

        var formData = new FormData();
        formData.append('id', "{{ $learningSpace->id ?? null }}");
        formData.append('name', nameInput.value);
        formData.append('location', locationInput.value);
        formData.append('description', descriptionTextarea.value);
        formData.append('min_capacity', minCapacityInput.value);
        formData.append('max_capacity', maxCapacityInput.value);
        formData.append('_token', "{{ csrf_token() }}");
        var amenitiesData = [];
        amenities.forEach((amenity) => {
            if(amenity.checked) {
                amenitiesData.push(amenity.getAttribute('id'));
            }
        });
        formData.append('amenities', amenitiesData);
        
        $.ajax({
            type: "POST",
            url: "{{ route('admin.learningspaces.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
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
</script>
@endsection