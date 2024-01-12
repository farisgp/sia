@extends('admin.app')
@section('content')
@php
$ar_gender = ["L","P"];
$ar_kelas = App\Models\Kelas::all();
$ar_agama = App\Models\Agama::all();
@endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Siswa</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('data_siswa.update', $row->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama_siswa" value="{{ $row->nama_siswa }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">NIS</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nis" value="{{ $row->nis }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">NISN</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nisn" value="{{ $row->nisn }}" class="form-control">
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
                                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_lahir" value="{{ $row->tanggal_lahir }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="id_kelas">
                                        <option selected>-- Pilih Kelas --</option>
                                        @foreach($ar_kelas as $kls)
                                        @php $pil = ($kls->id == $row->id_kelas) ? 'selected' : ''; @endphp
                                        <option value="{{ $kls->id }}" {{ $pil }}>{{ $kls->tingkat_kelas }}</option>
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
                                <label class="col-sm-2 col-form-label">Kontak Ortu</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kontak_ortu" value="{{ $row->kontak_ortu }}" class="form-control">
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
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">

                                    <a class="btn btn-info" title="Kembali" href=" {{ url('data_siswa') }}">
                                        <i class="bi bi-arrow-left-square"> Kembali</i>
                                    </a>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary" title="Simpan Perubahan"><i
                                            class="bi bi-save"></i> Update</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
