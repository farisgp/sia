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
                <div class="collapse navbar-collapse mt-1" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{url('/landingpage')}}" class="nav-item nav-link ">Home</a>
                        <a href="{{url('/tentang')}}" class="nav-item nav-link active">Tentang</a>
                        <a href="{{url('/visimisi')}}" class="nav-item nav-link">Visi Misi</a>
                    </div>
                    <div class="navbar-nav">
                        <a href="{{url('/login')}}" class="nav-link">
                            <button class="btn btn-outline-light rounded-pill">Login</button>
                        </a>
                    </div>
                    <!-- <div class="navbar-nav">
                        <a href="{{url('/register')}}" class="nav-link">
                            <button class="btn btn-outline-light rounded-pill">Register</button>
                        </a>
                    </div> -->
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
        <!-- Service Start -->
        <div class="container-fluid bg-primary hero-header py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12">
                        <div class="row g-4">
                            <div class="col-12 wow fadeIn" data-wow-delay="0.1s">
                                <div class="service-item justify-content-center  rounded">
                                    <h3 class="mb-4 text-center">PROFIL SEKOLAH</h3>
                                    <p>Peserta Didik di SD Negeri 02 Sijeruk 99% berasal dari Taman Kanak-kanak yang berada 
                                        di sekitar SD Negeri 02 Sijeruk baik itu Taman Kanak-kanak Negeri maupun dari Taman 
                                        Kanak-kanak swasta yang berada di lingkungan Desa Sijeruk. Hanya 1% saja yang bukan 
                                        berasal dari pendidikan Taman Kanak-kanak. 
                                        Latar belakang pada keagamaan peserta didik SD Negeri 02 Sijeruk  adalah    
                                        100% peserta didik beragama Islam, pada ekonomi berada pada level menengah ke bawah 
                                        namun dengan sarana  prasarana yang  cukup  memadai  dalam  mendukung  proses 
                                        pembelajaran baik intrakurikuler maupun ekstrakurikuler.</p>

                                    <p>Pendidik di SD Negeri 02 Sijeruk terdiri atas 6 orang guru kelas, 
                                        1 orang guru PABP, dan 1 guru PJOK. Seluruh guru baik guru kelas
                                         maupun guru mapel di SD Negeri 02 Sijeruk telah menyelesaikan 
                                         pendidikan dan memiliki ijazah terakhir S1 atau sarjana pendidikan.
                                        Guru kelas maupun guru mapel di SD Negeri 02 Sijeruk terinci dalam 
                                        penjelasan sebagai berikut. Guru kelas terdiri atas 2 orang adalah 
                                        Pegawai Negeri Sipil, 3 orang Pegawai Pemerintah dengan Perjanjian 
                                        Kerja, dan 1 orang Guru Wiyata Bakti. Sedangkan guru Mapel terdiri atas,
                                         1 orang guru PABP dan 1 orang  Wiyata Bakti mengajar Pendidikana Jasmani 
                                         Olahraga Kesehatan. 
                                        </p>

                                    <p>Tenaga Pendidik di SD Negeri 02 Sijeruk terdiri atas 3 orang Operator 
                                        Sekolah , 1 orang Pustakawan, dan 1 Penjaga Sekolah. Seluruh tenaga
                                         kependidikan di SD Negeri 02 Sijeruk telah menyelesaikan pendidikan 
                                         dan memiliki ijazah terakhir D2 untuk Operator Skoleah dan Pustakawan 
                                         sedangkan untuk Penjaga Sekolah memiliki ijazah terakhir SMA.
                                        Tenaga Kependidikan di SD Negeri 02 Sijeruk terinci ada 3 orang semuannya 
                                        masih merupakan tenaga PTT dan Karya Bakti.
                                        </p>

                                    <p>Secara  sosial  budaya,  peserta  didik memiliki latar belakang orang tua 
                                        yang berbeda budaya dan ekomnomi yang disebabkan dari sebagian orang tua 
                                        merupakan wiraswasta konveksi, pedagang, karyawan pabrik gula dan pegawai 
                                        pemerintahan yang ditempatkan tugas dan berasal dari luar daerah, warga 
                                        setempat dan warga desa lain di sekitar SD Negeri 02  Sijeruk. 
                                        Selain itu, minat bakat peserta didik juga yang sangat beragam, baik dalam 
                                        bidang akademik maupun dalam bidang non-akademik.</p>
                                        
                                    <p>Secara  sosial  budaya,  peserta  didik memiliki latar belakang orang tua 
                                        yang berbeda budaya dan ekomnomi yang disebabkan dari sebagian orang tua 
                                        merupakan wiraswasta konveksi, pedagang, karyawan pabrik gula dan pegawai 
                                        pemerintahan yang ditempatkan tugas dan berasal dari luar daerah, warga 
                                        setempat dan warga desa lain di sekitar SD Negeri 02  Sijeruk. 
                                        Selain itu, minat bakat peserta didik juga yang sangat beragam, baik dalam 
                                        bidang akademik maupun dalam bidang non-akademik.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        @endsection
