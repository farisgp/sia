@extends('landingpage.index')
@section('content')
    <!--=========================Intro Section============================-->
    <section id="intro">
        <div class="intro-container">
            <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

                <ol class="carousel-indicators"></ol>

                <div class="carousel-inner" role="listbox">

                    <div class="carousel-item active" style="background-image: url('img/facts-bg.jpg');">
                        <div class="carousel-container">
                            <div class="carousel-content">
                                <h2>Registrasi Berhasil</h2>
                                <p>
                                    Mohon ditunggu dan bersabar approve dari Admin
                                </p>
                                <a href="{{ route('login') }}" class="btn btn-outline-success">Click Here</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section><!-- #intro -->
@endsection
