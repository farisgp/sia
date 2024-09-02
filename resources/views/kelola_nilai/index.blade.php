
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
                        @elseif($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        @include('kelola_nilai.nilai-selector')
                        
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>

@endsection

