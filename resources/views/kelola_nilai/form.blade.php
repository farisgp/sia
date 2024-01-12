@extends('admin.app')
@section('content')
@php
$ar_kelas = ["kelas 1", "kelas 2", "kelas 3"];
$ar_guru = App\Models\Guru::all();
$ar_siswa = App\Models\Siswa::all();
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
                        <form method="POST" action="{{ route('nilai.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kelas</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('id_kelas') is-invalid @enderror" name="id_kelas">
                                        <option selected>-- Pilih Kelas --</option>
                                        @foreach($ar_kelas as $kls)
                                        @php
                                        $sel3 = (old('kls') == $kls)? 'selected':'';
                                        @endphp
                                        <option value="{{ $kls }}" {{ $sel3 }}>{{ $kls }}</option>
                                        @endforeach
                                    </select>
                                    @error('kls')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                <select class="form-select" name="id_siswa" id="id_siswa">
                                   
                                </select>
                                    <!-- <select class="form-select @error('id_siswa') is-invalid @enderror" name="id_siswa">
                                        <option selected>-- Pilih Siswa --</option>
                                        @foreach($siswa as $sis)
                                        @php
                                        $sel4 = (old('id_siswa') == $sis->id)? 'selected':'';
                                        @endphp
                                        <option value="{{ $sis->id }}" {{ $sel4 }}>{{ $sis->nama_siswa }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_siswa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror -->
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('id_mapel') is-invalid @enderror" name="id_mapel">
                                        <option selected>-- Pilih Mata Pelajaran --</option>
                                        @foreach($matapelajaran as $mapel)
                                        @php
                                        $sel2 = (old('id_mapel') == $mapel->id)? 'selected':'';
                                        @endphp
                                        <option value="{{ $mapel->id }}" {{ $sel3 }}>{{ $mapel->nama_mapel }}</option>
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
                                <label class="col-sm-2 col-form-label">LM 1</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lm1" value="{{ old('lm1') }}" 
                                    class="form-control @error('lm1') is-invalid @enderror">
                                    @error('lm1')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">LM 2</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lm2" value="{{ old('lm2') }}" 
                                    class="form-control @error('lm2') is-invalid @enderror">
                                    @error('lm2')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">LM 3</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lm3" value="{{ old('lm3') }}" 
                                    class="form-control @error('lm3') is-invalid @enderror">
                                    @error('lm3')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">LM 4</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lm4" value="{{ old('lm4') }}" 
                                    class="form-control @error('lm4') is-invalid @enderror">
                                    @error('lm4')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">LM 5</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lm5" value="{{ old('lm5') }}" 
                                    class="form-control @error('lm5') is-invalid @enderror">
                                    @error('lm5')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">LM 6</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lm6" value="{{ old('lm6') }}" 
                                    class="form-control @error('lm6') is-invalid @enderror">
                                    @error('lm6')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Rata Rata LM</label>
                                <div class="col-sm-10">
                                    <input type="text" name="rata_rata_lm" value="{{ old('rata_rata_lm') }}" 
                                    class="form-control @error('rata_rata_lm') is-invalid @enderror">
                                    @error('rata_rata_lm')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Tes</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tes" value="{{ old('tes') }}" 
                                    class="form-control @error('tes') is-invalid @enderror">
                                    @error('tes')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Non Tes</label>
                                <div class="col-sm-10">
                                    <input type="text" name="non_tes" value="{{ old('non_tes') }}" 
                                    class="form-control @error('non_tes') is-invalid @enderror">
                                    @error('non_tes')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Rata Rata SAS</label>
                                <div class="col-sm-10">
                                    <input type="text" name="rata_rata_sas" value="{{ old('rata_rata_sas') }}" 
                                    class="form-control @error('rata_rata_sas') is-invalid @enderror">
                                    @error('rata_rata_sas')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nilai Akhir</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nilai_akhir" value="{{ old('nilai_akhir') }}" 
                                    class="form-control @error('nilai_akhir') is-invalid @enderror">
                                    @error('nilai_akhir')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">

                                    <a class="btn btn-info" title="Kembali" href=" {{ url('nilai') }}">
                                        <i class="bi bi-arrow-left-square"> Kembali</i>
                                    </a>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary" title="Simpan Nilai"><i
                                            class="bi bi-save"></i>Simpan</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <script>
                            $(document).ready(function () {
                                $('#kelas').on('change', function () {
                                    var kelas = $(this).val();

                                    $.ajax({
                                        url: '/siswa/' + kelas,
                                        type: 'GET',
                                        dataType: 'json',
                                        success: function (data) {
                                            $('#siswa').empty();
                                            $.each(data, function (key, value) {
                                                $('#siswa').append('<option value="' + value.id + '">' + value.nama_siswa + '</option>');
                                            });
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
