@extends('admin.app')
@section('content')
@php
$ar_guru = App\Models\Guru::all();
$ar_siswa = App\Models\Siswa::all();
@endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Update Users</h5>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('kelola_user.update', $row->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nama" value="{{ $row->nama }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" value="{{ $row->username }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" value="{{ $row->password }}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <input type="text" name="role" value="{{ $row->role }}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">

                                    <a class="btn btn-info" title="Kembali" href=" {{ url('kelola_user') }}">
                                        <i class="bi bi-arrow-left-square"> Kembali</i>
                                    </a>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary" title="Simpan kelola_user"><i
                                            class="bi bi-save"></i> Simpan</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var selectGuru = document.querySelector('select[name="id_guru"]');
        var selectSiswa = document.querySelector('select[name="id_siswa"]');

        selectGuru.addEventListener("change", function() {
            // Jika pengguna (guru) dipilih, nonaktifkan opsi pengguna (siswa)
            selectSiswa.disabled = (selectGuru.value !== '');

            // Reset nilai pengguna (siswa) jika pengguna (guru) dipilih
            if (selectGuru.value !== '') {
                selectSiswa.value = '';
            }
        });

        selectSiswa.addEventListener("change", function() {
            // Jika pengguna (siswa) dipilih, nonaktifkan opsi pengguna (guru)
            selectGuru.disabled = (selectSiswa.value !== '');

            // Reset nilai pengguna (guru) jika pengguna (siswa) dipilih
            if (selectSiswa.value !== '') {
                selectGuru.value = '';
            }
        });
    });
</script>


@endsection
