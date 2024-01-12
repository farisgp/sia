@extends('admin.app')
@section('content')
@php
$ar_gender2 = ['L','P'];
$ar_kelas = App\Models\Kelas::all();
$ar_agama = App\Models\Agama::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Input Data Guru</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('data_guru.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_guru" value="{{ old('nama_guru') }}" 
                                    class="form-control @error('nama_guru') is-invalid @enderror">
                                    @error('nama_guru')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nip" value="{{ old('nip') }}" 
                                    class="form-control @error('nip') is-invalid @enderror">
                                    @error('nip')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="foto">
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                            <div class="col-sm-10">
                                @foreach($ar_gender2 as $jk)
                                @php
                                    $cek = (old('jk') == $jk)? 'checked':'';
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input @error('jk') is-invalid @enderror"  type="radio" name="jenis_kelamin" value="{{ $jk }}" {{ $cek }}>
                                    <label class="form-check-label" for="gridRadios1">
                                        {{ $jk }}
                                    </label>
                                </div>
                                @endforeach
                                @error('jk')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </fieldset>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pengampu ( Guru Kelas )</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('id_kelas') is-invalid @enderror" name="id_kelas">
                                        <option selected>-- Pilih Kelas --</option>
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
                                <label class="col-sm-2 col-form-label">Pengampu ( Guru Mata Pelajaran )</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('id_mapel') is-invalid @enderror" name="id_mapel">
                                        <option selected>-- Pilih Mata Pelajaran --</option>
                                        @foreach($ar_mapel as $mpl)
                                        @php
                                        $sel3 = (old('id_mapel') == $mpl->id)? 'selected':'';
                                        @endphp
                                        <option value="{{ $mpl->id }}" {{ $sel3 }}>{{ $mpl->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_mapel')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" style="height: 100px">{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kontak</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('kontak') }}" name="kontak" class="form-control @error('kontak') is-invalid @enderror">
                                    @error('kontak')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('id_agama') is-invalid @enderror" name="id_agama">
                                        <option selected>-- Pilih Agama --</option>
                                        @foreach($ar_agama as $agm)
                                        @php
                                        $sel2 = (old('id_agama') == $agm->id)? 'selected':'';
                                        @endphp
                                        <option value="{{ $agm->id }}" {{ $sel2 }}>{{ $agm->agama }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_agama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pendidikan</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('pendidikan') }}" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                                    @error('pendidikan')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ old('jabatan') }}" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                                    @error('jabatan')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">

                                    <a class="btn btn-info" title="Kembali" href=" {{ url('kelola_user') }}">
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
