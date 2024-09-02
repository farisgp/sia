@extends('admin.app')
@section('content')
@php
use App\Helpers\Qs;
$ar_kelas = App\Models\Kelas::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp

        <div class="card">
            <div class="card-header text-center">
                <h4 class="card-title font-weight-bold">Rekap Nilai Siswa </h4>
                <h4 class="card-title font-weight-bold">{{ $sr->nama_siswa.' || '.$kelas->tingkat_kelas.' || Tahun Ajaran '.$tahun_ajaran}}</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body ">
                
                @include('kelola_nilai.sheet')
            </div>
            
            
        </div>
        

@endsection
