@extends('layouts.admin')

@section('title')
  Create learning spaces &sdot; 
@endsection

@section('main-content-header')
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
                                <input type="text" class="form-control" placeholder="Type name..." value="{{ $learningSpace->name ?? NULL }}">
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" class="form-control" placeholder="Type location..." value="{{ $learningSpace->location ?? NULL }}">
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <textarea class="form-control" placeholder="Type description..." rows="3">{{ $learningSpace->description ?? NULL }}</textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>Minimum capacity</label>
                                    <input type="number" class="form-control" placeholder="Type minimum capacity..." min="1" max="30" value="{{ $learningSpace->min_capacity ?? NULL }}">
                                </div>
                                <div class="form-group col-6">
                                    <label>Maximum capacity</label>
                                    <input type="number" class="form-control" placeholder="Type maximum capacity..." min="1" max="30" value="{{ $learningSpace->max_capacity ?? NULL }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Cover</label>
                                <input type="file" class="form-control">
                            </div>
                            <div class="form-group">
                                <h5>Amenities</h5>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2">Wi-Fi</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                    <label class="form-check-label" for="exampleCheck2">Smart TV</label>
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <button class="btn bg-gradient-success">Save</button>
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
                            <div class="product-image-thumb active"><img src="/img/prod-1.jpg" alt="Product Image"></div>
                            <div class="product-image-thumb"><img src="/img/prod-2.jpg" alt="Product Image"></div>
                            <div class="product-image-thumb"><img src="/img/prod-3.jpg" alt="Product Image"></div>
                            <div class="product-image-thumb"><img src="/img/prod-4.jpg" alt="Product Image"></div>
                            <div class="product-image-thumb"><img src="/img/prod-5.jpg" alt="Product Image"></div>
                        </div>
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