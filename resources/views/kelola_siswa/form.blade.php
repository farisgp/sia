@extends('admin.app')
@section('content')
@php
$ar_gender = ['L','P'];
$ar_kelas = App\Models\Kelas::all();
$ar_agama = App\Models\Agama::all();
@endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Input Data Siswa</h5>
                        <br>
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
                        <form method="POST" class="row g-3" action="{{ route('data_siswa.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-3">
                                <label class="col-sm-4 col-form-label">Nama<span class="required"> *</span></label>
                                    <input type="text" name="nama_siswa" value="{{ old('nama_siswa') }}" 
                                    class="form-control @error('nama_siswa') is-invalid @enderror">
                                    @error('nama_siswa')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-4 col-form-label">NIS<span class="required"> *</span></label>
                                    <input type="number" name="nis" value="{{ old('nis') }}" 
                                    class="form-control @error('nis') is-invalid @enderror">
                                    @error('nis')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-4 col-form-label">NISN<span class="required"> *</span></label>
                                    <input type="number" name="nisn" value="{{ old('nisn') }}" 
                                    class="form-control @error('nisn') is-invalid @enderror">
                                    @error('nisn')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-4 col-form-label">Alamat<span class="required"> *</span></label>
                                <input type="text" name="alamat" value="{{ old('alamat') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-5 col-form-label">Username<span class="required"> *</span></label>
                                    <input type="text" name="username" value="{{ old('username') }}" 
                                    class="form-control @error('username') is-invalid @enderror">
                                    @error('username')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-5 col-form-label">Password<span class="required"> *</span></label>
                                    <input type="password" name="password" value="{{ old('password') }}" 
                                    class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                            </div>
                            <div class="col-md-3">
                                <label class="col-sm-3 col-form-label">Kelas<span class="required"> *</span></label>
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
                            <div class="col-md-3">
                                <label class="col-sm-4 col-form-label">Agama<span class="required"> *</span></label>
                                    <select class="form-select @error('id_agama') is-invalid @enderror" name="id_agama">
                                        <option selected disabled>-- Pilih Agama --</option>
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
                            <div class="col-md-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="foto">
                                </div>
                            </div>
                            <fieldset class="col-md-3">
                            <legend class="col-form-label pt-0">Jenis Kelamin<span class="required"> *</span></legend>
                            <div class="col-sm-10">
                                @foreach($ar_gender as $jk)
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
                            <div class="col-md-3">
                                <label class="col-form-label">Tanggal Lahir<span class="required"> *</span></label>
                                <div class="col-sm-10">
                                    <input type="date" name="tanggal_lahir" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="col-form-label">Kontak Ortu</label>
                                <div class="col-sm-10">
                                    <input type="number" name="kontak_ortu" class="form-control">
                                </div>
                            </div>
                            

                            <div class="col-md-12">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">
                                    <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                                            class="bi bi-save"></i> Simpan</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
