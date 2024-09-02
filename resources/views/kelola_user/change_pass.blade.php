@extends('admin.app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ubah Password</h5>
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
                        <form method="POST" action="{{ route('setting.change_pass') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Password Saat Ini</label>
                                <div class="col-sm-10">
                                    <input id="current_password" name="current_password" required type="password" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Password Baru</label>
                                <div class="col-sm-10">
                                    <input id="password" name="password" required type="password" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Konfirmasi Password Baru</label>
                                <div class="col-sm-10">
                                    <input id="password_confirmation" name="password_confirmation" required type="password" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary" title="Simpan Password"><i
                                            class="bi bi-save"></i> Simpan</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
