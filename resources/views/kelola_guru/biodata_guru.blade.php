@extends('admin.app')
@section('content')
@php
$ar_gender2 = ['L','P'];
$ar_kelas = App\Models\Kelas::all();
$ar_agama = App\Models\Agama::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp
    <section id="services">
        <div class="container">
          
            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                            <table>
                                
                            <tr>
                                <th>Nama</th>
                                <th>{{$profile->guru->nama_guru}}</th>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <th>tes</th>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <th>tes</th>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <th>tes</th>
                            </tr>
                            <tr>
                                <th>Kontak</th>
                                <th>tes</th>
                            </tr>
                            <tr>
                                <th>Agama</th>
                                <th>tes</th>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                                <th>tes</th>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th><a class="btn btn-info" title="Kembali" href=" {{ url('dashboard') }}">
                                        <i class="bi bi-arrow-left-square"> Kembali</i>
                                    </a></th>
                            </tr>
                            </table>
                </div>

            </div>
        </div>

        </div>
    </section><!-- #services -->
@endsection
