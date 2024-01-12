    @extends('landingpage.index')
    @section('content')
    <!-- Navbar Start -->
    <div class="container-fluid sticky-top ">
        <div class="container ">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <a class="navbar-brand" href="index.html">
                    <img src="{{url('img/logo.png')}}" alt="Logo">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mx-auto mt-1" id="navbarCollapse">
                    <div class="navbar-nav mx-auto ">
                        <a href="{{url('/landingpage')}}" class="nav-item nav-link active">Home</a>
                        <a href="{{url('/tentang')}}" class="nav-item nav-link">Tentang</a>
                        <a href="{{url('/visimisi')}}" class="nav-item nav-link">Visi Misi</a>
                    </div>
                    <div class="navbar-nav">
                        <a href="{{route('login')}}" class="nav-link">
                            <button class="btn btn-outline-light rounded-pill">Login</button>
                        </a>
                    </div>
                    <div class="navbar-nav">
                        <a href="{{route('register.form')}}" class="nav-link">
                            <button class="btn btn-outline-light rounded-pill">Register</button>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
    <!-- Hero Start -->
    <div class="container-fluid pt-5 bg-primary hero-header mb-0">
        <div class="container pt-4">
            <div class="row g-5 pt-5 pb-4">
                <div class="col-lg-6 align-self-center text-center text-lg-start mb-lg-5">
                    <div class="btn btn-sm border rounded-pill text-white px-3 mb-3 animated slideInRight">S . I . A</div>
                    <h1 class="display-4 text-white mb-4 animated slideInRight">Sistem Informasi Akademik SDN 02 Sijeruk</h1>
                    <p class="text-white mb-4 animated slideInRight">Tempor rebum no at dolore lorem clita rebum rebum ipsum
                        rebum stet dolor sed justo kasd. Ut dolor sed magna dolor sea diam. Sit diam sit</p>
                    <a href="{{url('/login')}}" class="btn btn-light py-sm-3 px-sm-5 rounded-pill me-3 animated slideInRight">Login</a>
                    <!-- <a href="" class="btn btn-outline-light py-sm-3 px-sm-5 rounded-pill animated slideInRight">Login</a> -->
                </div>
                <div class="col-lg-6 align-self-center text-center text-lg-start mb-lg-5">
                    <div class="case-item position-relative overflow-hidden rounded mb-2">
                        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner  ">
                              <div class="carousel-item active">
                                <img src="{{url('img/upacara.jpeg')}}" alt="Image" class="img-fluid">
                              </div>
                              <div class="carousel-item">
                                <img src="{{url('img/karnaval.jpg')}}" alt="Image" class="img-fluid">
                              </div>
                              <div class="carousel-item">
                                <img src="{{url('img/drumband.jpg')}}" alt="Image" class="img-fluid">
                              </div>
                              <div class="carousel-item">
                                <img src="{{url('img/pramuka.jpeg')}}" alt="Image" class="img-fluid">
                              </div>
                            </div>
                          </div>
					</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->
@endsection

