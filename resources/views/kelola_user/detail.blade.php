@extends('admin.app')
@section('content')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        @empty($row->foto)
                            <img src="{{ url('admin/img/nophoto.png') }}" alt="Profile" class="rounded-circle">
                        @else
                            <img src="{{ url('admin/img') }}/{{ $row->foto }}" alt="Profile" class="rounded-circle">
                        @endempty
                        <h2>{{ $row->name }}</h2>
                    </div>
                    <div class="card-body" align="center">
                        <div class="alert alert-secondary">
                            Email: {{ $row->email }}
                        </div>
                        <a class="btn btn-info btn-sm" title="Kembali" href=" {{ url('kelola_user') }}">
                            <i class="bi bi-arrow-left-square"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
