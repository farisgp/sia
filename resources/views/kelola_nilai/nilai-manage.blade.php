
@extends('admin.app')
@section('content')
@php
use App\Helpers\Qs;
$ar_kelas = App\Models\Kelas::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Input Nilai</h5>
                        <h2 class="card-title">Tahun Pelajaran : {{ Qs::getSetting('tahun_ajaran') }}</h2>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @include('kelola_nilai.nilai-selector')
                    </div>
                    
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                        <div class="col-md-4">
                    @if(!is_null($m))
                        <h6 class="card-title"><strong>Kelas: </strong> {{ $m->kelas->tingkat_kelas }}</h6>
                    @else
                        <h6 class="card-title">Tidak Ada Data Siswa Pada Kelas Yang Dipilih</h6>
                    @endif
                </div>
                <div class="col-md-4">
                    @if(!is_null($m))
                        <h6 class="card-title"><strong>Mata Pelajaran: </strong> {{ $m->mata_pelajaran->nama_mapel }}</h6>
                    @else
                        <h6 class="card-title"></h6>
                    @endif
                </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('kelola_nilai.nilai_edit')
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

