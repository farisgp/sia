@extends('admin.app')
@section('content')
@php
$ar_gender = ["L","P"];
$ar_mapel = App\Models\MataPelajaran::all();
$ar_agama = App\Models\Agama::all();
$ar_kelas = App\Models\Kelas::all();
@endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Guru</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('data_guru.update', $row->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_guru" value="{{ $row->nama_guru }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nip" value="{{ $row->nip }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="foto">
                                    @if (!empty($row->foto))
                                        <img src="{{ url('admin/img') }}/{{ $row->foto }}" width="10%"
                                            class="img-thumbnail">
                                        <br />{{ $row->foto }}
                                    @endif
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                                <div class="col-sm-10">
                                    @foreach($ar_gender as $gender)
                                        @php $cek = ($gender == $row->jenis_kelamin) ? 'checked' : ''; @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                                value="{{ $gender }}" {{ $cek }}>
                                            <label class="form-check-label" for="gridRadios1">
                                                {{ $gender }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pengajar</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="id_mapel">
                                        <option selected>-- Pilih Mata Pelajaran --</option>
                                        @foreach($ar_mapel as $mpl)
                                        @php $pil = ($mpl->id == $row->id_mapel) ? 'selected' : ''; @endphp
                                        <option value="{{ $mpl->id }}" {{ $pil }}>{{ $mpl->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pengampu</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="id_kelas">
                                        <option selected>-- Pilih Kelas --</option>
                                        @foreach($ar_kelas as $kls)
                                        @php $pil = ($kls->id == $row->id_kelas) ? 'selected' : ''; @endphp
                                        <option value="{{ $kls->id }}" {{ $pil }}>{{ 'Guru '.$kls->tingkat_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" name="alamat" value="{{ $row->alamat }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kontak</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kontak" value="{{ $row->kontak }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="id_agama">
                                        <option selected>-- Pilih Agama --</option>
                                        @foreach($ar_agama as $agm)
                                            @php $pil = ($agm->id == $row->id_agama) ? 'selected' : ''; @endphp
                                            <option value="{{ $agm->id }}" {{ $pil }}>{{ $agm->agama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pendidikan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="pendidikan" value="{{ $row->pendidikan }}" class="form-control">
                                </div>
                            </div><div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="jabatan" value="{{ $row->jabatan }}" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">

                                    <a class="btn btn-info" title="Kembali" href=" {{ url('data_guru') }}">
                                        <i class="bi bi-arrow-left-square"> Kembali</i>
                                    </a>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary" title="Simpan Perubahan"><i
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
