    @extends('landingpage.index')
    @section('content')
    <!-- Navbar Start -->
    <div class="container-fluid sticky-top ">
        <div class="container ">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <a class="navbar-brand" href="index.html">
                    <img src="img/logo.png" alt="Logo">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mt-1" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{url('/landingpage')}}" class="nav-item nav-link ">Home</a>
                        <a href="{{url('/tentang')}}" class="nav-item nav-link ">Tentang</a>
                        <a href="{{url('/visimisi')}}" class="nav-item nav-link active">Visi Misi</a>
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
                                    <h3 class="mb-3 text-center">VISI</h3>
                                    <p>Terwujudnya Siswa yang Bertaqwa, Berprestasi, Berbudaya, Bertanggung Jawab, Berwawasan Lingkungan dan Global 
                                        Visi sekolah dapat terwujud apabila terpenuhi indikator-indikator sebagai berikut :</p>
                                        <table>
                                            <tr>
                                                <td>
                                                    <ol type="1">
                                                        <li>Terwujudnya nilai-nilai ajaran Agama.</li>
                                                        <li>Terwujudnya proses pembelajaran yang efektif dan efesien.</li>
                                                        <li>Terwujudnya standar penilaian sesuai standar kompetensi lulusan.</li>
                                                        <li>Terwujudnya peserta didik yang memiliki kompetensi sesuai standar kompetensi yang tercantum dalam standar isi pendidikan dasar.</li>
                                                        <li>Terwujudnya lulusan yang berakhlak mulia, disiplin, tangguh, cerdas, terampil, jujur, sehat jasmani dan rohani, kreatif, dan kompetitif.</li>
                                                        <li>Terwujudnya manajemen sekolah yang efektif dan efisien.</li>
                                                        <li>Terwujudnya prestasi akademik dan non akademik.</li>
                                                        <li>Terwujudnya para pendidik dan tenaga kependidikan yang memiliki kompetensi dan kualifikasi yang dipersyaratkan Standar Nasional Pendidikan.</li>
                                                        <li>Terwujudnya prasarana dan sarana pendidikan standar yang mendukung proses pembelajaran,</li>
                                                    </ol>
                                                </td>
                                            </tr>
                                        </table>
                                        
                                        <h3 class="mb-3 mt-2 text-center">MISI</h3>
                                    <p>Dalam upaya mengimplementasikan visi sekolah, SD Negeri 02 Sijeruk menjabarkan misi sekolah sebagai berikut:  </p>
                                        <table>
                                            <tr>
                                                <td>
                                                    <ol type="1">
                                                        <li>Meningkatkan ketaqwaan kepada Tuhan Yang Maha Esa warga sekolah dalam kehidupan sehari-hari.</li>
                                                        <li>Menumbuhkembangkan karakter, kompetensi, bakat, dan minat sesuai profil pelajar Pancasila melalui pembelajaran yang inovatif, efektif dan partisipatif.</li>
                                                        <li>Meningkatkan prestasi akademik, non akademik dan prestasi di bidang keagamaan.</li>
                                                        <li>Mewujudkan manusia Indonesia yang mampu berkontribusi pada kehidupan bermasyarakat, berbangsa, bernegara dalam peradaban dunia.</li>
                                                        <li>Meningkatkan Sumber Daya Manusia (SDM) warga sekolah.</li>
                                                        <li>Meningkatkan kemampuan intelektual, spiritual dan emosional.</li>
                                                        <li>Membiasakan budaya tertib, disiplin, santun dalam ucapan, sopan dalam prilaku terhadap sesama berdasarkan iman dan takwa.</li>
                                                        <li>Membiasakan lingkungan yang bersih, nyaman, indah dan sehat di lingkungan sekolah dan tempat tinggal.</li>
                                                    </ol>
                                                </td>
                                            </tr>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->

        @endsection

