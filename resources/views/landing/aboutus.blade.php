@extends('layouts.landing')

@section('title')
    About Us &sdot; 
@endsection

@section('content')
<main class="main">
  <!-- About Us -->
  <section class="articles py-5">
    <div class="container">
      <div class="section-heading">
        <h2>About Us</h2>
      </div>
      <div class="section-content">
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="text-center">
                        <div class="img-hover-zoom img-hover-zoom--colorize">
                            <img class="shadow" src="images/avatars/daryl-vargas.jpg"
                                alt="Another Image zoom-on-hover effect">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="clearfix mb-3">
                        </div>
                        <div class="my-2 text-center">
                            <h1>Daryl Vargas</h1>
                        </div>
                        <div class="mb-3">
                            <h2 class="text-uppercase text-center role">Proponent</h2>
                        </div>
                        <div class="box">
                            <div>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><i class="fab fa-facebook"></i></li>
                                    <li class="list-inline-item"><i class="fab fa-linkedin-in"></i></li>
                                    <li class="list-inline-item"><i class="fab fa-instagram"></i></li>
                                    <li class="list-inline-item"><i class="fab fa-twitter"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="text-center">
                        <div class="img-hover-zoom img-hover-zoom--colorize">
                            <img class="shadow" src="images/avatars/jude-noel-riego-de-dios.png"
                                alt="Another Image zoom-on-hover effect">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="clearfix mb-3">
                        </div>
                        <div class="my-2 text-center">
                            <h1>Jude Noel Riego De Dios</h1>
                        </div>
                        <div class="mb-3">
                            <h2 class="text-uppercase text-center role">Proponent</h2>
                        </div>
                        <div class="box">
                            <div>
                                <ul class="list-inline">
                                    <li class="list-inline-item"><i class="fab fa-facebook"></i></li>
                                    <li class="list-inline-item"><i class="fab fa-linkedin-in"></i></li>
                                    <li class="list-inline-item"><i class="fab fa-instagram"></i></li>
                                    <li class="list-inline-item"><i class="fab fa-twitter"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
</main>
<style>
    .card {
        background: #fff;
        box-shadow: 0 6px 10px rgba(0, 0, 0, .08), 0 0 6px rgba(0, 0, 0, .05);
        border: 1;
        border-radius: 1rem;
    }

    .img-hover-zoom--colorize img {
        border-radius: 50%;
        width: 150px;
        height: auto;
        margin-top: 20px;
        padding: 1px;
        transition: transform .5s;
        filter: grayscale(100%);
    }

    .img-hover-zoom--colorize:hover img {
        filter: grayscale(0);
        transform: scale(1.05);
    }

    .card h5 {
        overflow: hidden;
        height: 80px;
        font-weight: 300;
        font-size: 1rem;
    }

    .card h5 a {
        color: black;
        text-decoration: none;
    }

    .role {
        color: #7a7a7a;
    }

    .box {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fab {
        font-size: 1.5rem;
        color: darkgray;
        transition: transform .5s;
    }

    .fab:hover {
        color: black;
        transform: scale(1.1);
    }

    .card h2 {
        font-size: 1rem;
    }


    /* MEDIA */

    @media only screen and (min-width: 1200px) {
        .img-hover-zoom--colorize img {
            width: 200px;
        }
    }

    @media only screen and (min-width: 1200px) {
        .h1,
        h1 {
            font-size: 2rem;
        }
    }
</style>
@endsection