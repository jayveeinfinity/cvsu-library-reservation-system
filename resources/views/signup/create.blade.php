@extends('layouts.welcome')

@section('title')
    Sign up
@endsection

@section('main-content-header')
    <div class="container-fluid bg-cvsu-green">
        <div class="container py-3">
            <div class="d-flex align-items-center">
                <div class="mr-3">
                    <img src="{{asset('images/CvSU-logo-64x64.webp')}}">
                </div>
                <div class="d-flex flex-column align-items-start">
                    <h1 class="nav-header-title mb-0">Cavite State University</h1>
                    <h3 class="nav-header-sub mb-0">Office of the Alumni Affairs</h3>
                </div>
            </div>
        </div>
    </div>
@endsection 

@section('main-content')
    <div class="container-fluid">
        <div class="container">
            <div class="card mt-3">
                <div class="card-body">
                    <form>
                        <h4>Personal Information</h4>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" placeholder="Email...">
                        </div>
                        <div class="form-group">
                            <label>Student Number</label>
                            <input class="form-control" type="text" placeholder="Student Number...">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" placeholder="Name...">
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Course</label>
                                    <input class="form-control" type="text" placeholder="Course...">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Year graduated</label>
                                    <select class="form-control">
                                        <option value="" selected disabled>Choose year...</option>
                                        @php
                                            for($i = date('Y'); $i >= 1906; $i--) {
                                                echo '<option value="' . $i . '">' . $i . '</option>';
                                            }
                                        @endphp
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 text-right">
                            <button class="btn btn-primary">Create an account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection