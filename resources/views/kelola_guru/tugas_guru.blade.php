
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
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title font-weight-bold">Daftar Guru SDN 02 Sijeruk Sragi Pekalongan</h5>
                        <a href="{{ route('guru.lihat_guru_keluar') }}" class="btn btn-secondary">Daftar Guru Keluar</a>
                    </div>

                    <div class="card-body">
                    <form method="post" action="{{ route('guru.tugas_guru_promote') }}">
                        @csrf
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jenis Guru</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guru->sortBy('kelola.nama') as $sr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>@empty($row->foto)
                                            <img src="{{ url('admin/img/nophoto.png') }}" width="30%" alt="Profile"
                                                class="rounded-circle">
                                        @else
                                            <img src="{{ url('admin/img') }}/{{ $row->foto }}" width="30%" alt="Profile"
                                                class="rounded-circle">
                                        @endempty</td>
                                    <td>{{ $sr->nama_guru }}</td>
                                    <td>{{ $sr->nip }}</td>
                                    <td>{{ $sr->jenis_guru}}</td>
                                    <td>
                                        <select class="form-control select" name="p-{{$sr->id}}" id="p-{{$sr->id}}">
                                            <option value="B">Bertugas</option>
                                            <option value="DB">Diberhentikan</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <button class="btn btn-success"><i class="icon-stairs-up mr-2"></i> Promote Guru</button>
                        </div>
                    </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

@endsection

