@extends('admin.app')
@section('content')
@php
$ar_hari = ['Senin','Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$ar_kelas = App\Models\Kelas::all();
$ar_guru = App\Models\Guru::all();
$ar_mapel = App\Models\MataPelajaran::all();

@endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Input Jadwal Pelajaran</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('jadwal.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('id_kelas') is-invalid @enderror" name="id_kelas">
                                        <option selected disabled>-- Pilih Kelas --</option>
                                        @foreach($ar_kelas as $kls)
                                        @php
                                        $sel2 = (old('id_kelas') == $kls->id)? 'selected':'';
                                        @endphp
                                        <option value="{{ $kls->id }}" {{ $sel2 }}>{{ $kls->tingkat_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('id_mata_pelajaran') is-invalid @enderror" name="id_mata_pelajaran">
                                        <option selected disabled>-- Pilih Mata Pelajaran --</option>
                                        @foreach($ar_mapel as $mpl)
                                        @php
                                        $sel3 = (old('id_mata_pelajaran') == $mpl->id)? 'selected':'';
                                        @endphp
                                        <option value="{{ $mpl->id }}" {{ $sel3 }}>{{ $mpl->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_mata_pelajaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Guru Pengampu</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('id_guru') is-invalid @enderror" name="id_guru">
                                        <option selected disabled>-- Pilih Guru Pengampu --</option>
                                        @foreach($ar_guru as $gru)
                                        @php
                                        $sel4 = (old('id_guru') == $gru->id)? 'selected':'';
                                        @endphp
                                        <option value="{{ $gru->id }}" {{ $sel4 }}>{{ $gru->nama_guru }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_guru')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Hari</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('hari') is-invalid @enderror" name="hari">
                                        <option selected disabled>-- Pilih Hari --</option>
                                        @foreach($ar_hari as $hari)
                                        @php
                                        $selHari = (old('hari') == $hari)? 'selected':'';
                                        @endphp
                                        <option value="{{ $hari }}" {{ $selHari }}>{{ $hari }}</option>
                                        @endforeach
                                    </select>
                                    @error('hari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pukul</label>
                                <div class="col-sm-10">
                                    <input type="time" value="{{ old('waktu') }}" name="waktu" class="form-control @error('waktu') is-invalid @enderror">
                                    @error('waktu')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">

                                    <a class="btn btn-info" title="Kembali" href=" {{ url('jadwal') }}">
                                        <i class="bi bi-arrow-left-square"> Kembali</i>
                                    </a>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                                            class="bi bi-save"></i>Simpan</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
