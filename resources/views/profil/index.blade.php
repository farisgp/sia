@extends('admin.app')
@section('content')
    <section id="services">
        <div class="container">
          
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <h5 class="card-title">Profile</h5>
                            @if ($user->guru)
                            @empty($user->guru->foto)
                            <img src="{{ url('admin/img/nophoto.png') }}" alt="Profile" class="rounded-circle" style="width: 145px; height: 145px;">
                            @else
                            <img src="{{ url('admin/img')}}/{{$user->guru->foto}}" alt="Profile" class="rounded-circle" style="width: 145px; height: 145px;">
                            @endempty
                            </br>
                            <div class="alert alert-secondary container" align="center">
                                <table colspan="10" >
                                <tr>
                                    <th style="padding-left: 30px;">Nama</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->guru->nama_guru}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">NIP</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->guru->nip}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Jenis Kelamin</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->guru->jenis_kelamin}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Alamat</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->guru->alamat}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Kontak</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->guru->kontak}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Agama</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->guru->agama->agama}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Pendidikan</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->guru->pendidikan}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Jabatan</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->guru->jabatan}}</th>
                                </tr>
                                
                                </table>
                                <a class="btn btn-info mt-3" title="Kembali" href=" {{ url('dashboard') }}">
                                            <i class="bi bi-arrow-left-square"> Kembali</i>
                                        </a>
                                @elseif ($user->siswa)
                                @empty($user->siswa->foto)
                                <img src="{{ url('admin/img/nophoto.png') }}" alt="Profile" class="rounded-circle" style="width: 145px; height: 145px;">
                                @else
                                <img src="{{ url('admin/img')}}/{{$user->siswa->foto}}" alt="Profile" class="rounded-circle" style="width: 145px; height: 145px;">
                                @endempty
                                <table colspan="10" >
                                <tr>
                                    <th style="padding-left: 30px;">Nama</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->nama_siswa}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">NIS</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->nis}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">NISN</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->nisn}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Jenis Kelamin</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->jenis_kelamin}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Tanggal Lahir</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->tanggal_lahir}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Kelas</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->kelas->tingkat_kelas}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Alamat</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->alamat}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Kontak Ortu</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->kontak_ortu}}</th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 30px;">Agama</th>
                                    <th style="padding-left: 30px;">:</th>
                                    <th style="padding-left: 5px;">{{$user->siswa->agama->agama}}</th>
                                </tr>
                                
                                </table>
                                <a class="btn btn-info mt-3" title="Kembali" href=" {{ url('dashboard') }}">
                                            <i class="bi bi-arrow-left-square"> Kembali</i>
                                        </a>
                                @endif
                            </div>
                            
                </div>

            </div>
        </div>

        </div>
    </section><!-- #services -->
@endsection
