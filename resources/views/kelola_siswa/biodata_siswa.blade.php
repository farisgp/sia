@extends('admin.app')
@section('content')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <h2>{{ $row->nama_siswa }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-secondary container">
                            <div class="row">
                                <div class="col-sm-2">Nama</div>
                                <div class="col">: {{ $row->nama_siswa }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">NIS</div>
                                <div class="col">: {{ $row->nis }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">NISN</div>
                                <div class="col">: {{ $row->nis }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">Jenis Kelamin</div>
                                <div class="col">: {{ $row->jenis_kelamin }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">Tanggal Lahir</div>
                                <div class="col">: {{ $row->tanggal_lahir }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">Kelas</div>
                                <div class="col">: {{ $row->kelas->tingkat_kelas }}</div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-2">Alamat</div>
                                <div class="col">: {{ $row->alamat }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">Kontak Ortu</div>
                                <div class="col">: {{ $row->kontak_ortu }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2">Agama</div>
                                <div class="col">: {{ $row->agama->agama }}</div>
                            </div>
                        </div>
                        <a class="btn btn-info btn-sm" title="Kembali" href=" {{ url('dashboard') }}">
                            <i class="bi bi-arrow-left-square"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
