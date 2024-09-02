
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
                    <div class="card-body">
                        <h5 class="card-title">Kelulusan Siswa</h5>
                        <h5 class="card-title font-weight-bold">Kelulusan Siswa Pada Tahun Ajaran <span class="text-danger">{{ $old_year }}</h5>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @elseif($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <form id="sellNilai" method="POST" class="row g-3" action="{{ route('siswa.graduate_selector') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-3">
                                <label for="kelas_lama" class="col-sm-5 col-form-label">Kelas</label>
                                <select class="form-select @error('kelas_lama') is-invalid @enderror" id="kelas_lama" name="kelas_lama">
                                    <option disabled selected>-- Pilih Kelas --</option>
                                    @foreach($kelas as $c)
                                        <option {{ ($selected && $kelas_lama == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->tingkat_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10 mt-3">
                                    <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                                            class="bi bi-save"></i> Kelola Kelulusan</button>&nbsp;
                                </div>
                            </div>
                        </form>
                            <div class="col-md-6">
                                <div class="col-sm-10 mt-3">
                                    <a href="{{ route('siswa.show_graduated')}}" class="btn btn-secondary" title="Simpan Stakeholder"><i
                                            class="bi bi-save"></i> Data Kelulusan</a>&nbsp;
                                </div>
                            </div>
                        
                    </div>
                    
                </div>
                @if($selected)
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h5 class="card-title font-weight-bold">Kelola Kelulusan Siswa Kelas <span class="text-teal">{{ $kelas->where('id', $kelas_lama)->first()->tingkat_kelas }}</h5>
                    </div>

                    <div class="card-body">
                    <form method="post" action="{{ route('siswa.siswa_graduated', [$kelas_lama]) }}">
                        @csrf
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>Tahun Ajaran</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($siswa->sortBy('kelola.nama') as $sr)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="rounded-circle" style="height: 30px; width: 30px;" src="{{ $sr->foto }}" alt="img"></td>
                                    <td>{{ $sr->nama_siswa }}</td>
                                    <td>{{ $sr->tahun_ajaran }}</td>
                                    <td>
                                        <select class="form-control select" name="p-{{$sr->id}}" id="p-{{$sr->id}}">
                                            <option value="G">Lulus</option>
                                            <option value="NG">Tidak Lulus</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <button class="btn btn-success"><i class="icon-stairs-up mr-2"></i> Promote Students</button>
                        </div>
                    </form>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </section>

@endsection

