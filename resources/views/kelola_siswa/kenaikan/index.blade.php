
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
                        <h5 class="card-title">Kenaikan Kelas</h5>
                        <h5 class="card-title font-weight-bold">Kenaikan Kelas Siswa Dari Tahun Ajaran <span class="text-danger">{{ $old_year }}</span> Ke Tahun Ajaran <span class="text-success">{{ $new_year }}</span> </h5>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @elseif($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        @include('kelola_siswa.kenaikan.selector')
                    
                        
                    </div>
                    
                </div>
                @if($selected)
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title font-weight-bold">Siswa Dari Kelas <span class="text-teal">{{ $kelas->where('id', $kelas_lama)->first()->tingkat_kelas }}</span> Naik Ke Kelas <span class="text-purple">{{ $kelas->where('id', $kelas_baru)->first()->tingkat_kelas }}</span> </h5>
                    </div>

                    <div class="card-body">
                        @include('kelola_siswa.kenaikan.promote')
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </section>

@endsection

