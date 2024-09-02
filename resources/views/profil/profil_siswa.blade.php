@extends('admin.app')
@section('content')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        @empty($sr->foto)
                            <img src="{{ url('admin/img/nophoto.png') }}" style="max-width:60%; max-height:60%" alt="Profile">
                        @else
                            <img src="{{ url('admin/img') }}/{{ $sr->foto }}" style="max-width:60%; max-height:60%" alt="Profile">
                        @endempty
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h5 class="card-title">Profile</h5>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Nama </div>
                        <div class="col-lg-9 col-md-8">{{ $sr->nama_siswa }}</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">NIS</div>
                        <div class="col-lg-9 col-md-8">{{ $sr->nis }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">NISN</div>
                        <div class="col-lg-9 col-md-8">{{ $sr->nisn }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Jenis Kelamin </div>
                        <div class="col-lg-9 col-md-8">{{ $sr->jenis_kelamin }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Tanggal Lahir</div>
                        <div class="col-lg-9 col-md-8">{{ $sr->tanggal_lahir }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Agama</div>
                        <div class="col-lg-9 col-md-8">{{ $sr->agama->agama }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Kelas</div>
                        <div class="col-lg-9 col-md-8">{{ $sr->kelas->tingkat_kelas }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                        <div class="col-lg-9 col-md-8">{{ $sr->alamat }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Kontak Ortu</div>
                        <div class="col-lg-9 col-md-8">{{ $sr->kontak_ortu }}</div>
                    </div>

                    </div>
                    </div>

                </div><!-- End Bordered Tabs -->

                </div>
            </div>

            </div>
        </div>
    </section>
@endsection
