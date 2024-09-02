
@extends('admin.app')
@section('content')
@php
use App\Helpers\Qs;
use Hashids\Hashids;
$ar_kelas = App\Models\Kelas::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Print Nilai Siswa</h5>
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

                        <form method="POST" class="row g-3" action="{{ route('nilai.bulk_select') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <label class="col-sm-3 col-form-label">Kelas</label>
                                <select class="form-select @error('id_kelas') is-invalid @enderror" id="id_kelas" name="id_kelas">
                                    <option selected disabled>-- Pilih Kelas --</option>
                                    @php
                                    $user = auth()->user();
                                    $idKelasGuru = [];
                                    $kelas = App\Models\Kelas::all();

                                    if (!$user->guru) {
                                        foreach ($kelas as $kelasItem) {
                                            echo '<option value="' . $kelasItem->id . '">' . ' ' . $kelasItem->tingkat_kelas . '</option>';
                                        }
                                    } else {
                                        $idKelasGuru = json_decode($user->guru->id_kelas);
                                        foreach ($idKelasGuru as $kelas_id) {
                                            echo '<option value="' . $kelas_id . '">' . 'Kelas ' . $kelas_id . '</option>';
                                        }
                                    }
                                    
                                    @endphp
                                    <!-- @foreach($idKelasGuru as $kelas_id)
                                        @php
                                            $kelas = $kelas_id;
                                        @endphp
                                            @if($kelas)
                                                <option value="{{ $kelas }}" {{ $selected && $kelas == 'id_kelas' ? 'selected' : '' }}>{{ 'Kelas '.$kelas }}</option>
                                            @endif
                                    @endforeach -->
                                </select>
                                @error('id_kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="col-md-4">
                                <label class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10 mt-3">
                                    <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                                            class="bi bi-save"></i> Lihat</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                @if($selected)
                <div class="card">
                    <div class="card-body">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Photo</th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $no= 1; @endphp
                            @foreach($siswa as $s)
                                <tr>
                                    <td scope="row">{{ $no++ }}</td>
                                    <td>
                                        @empty($s->foto)
                                            <img src="{{ url('admin/img/nophoto.png') }}" width="40%" alt="Profile"
                                                class="rounded-circle">
                                        @else
                                            <img src="{{ url('admin/img') }}/{{ $s->foto }}" width="40%" alt="Profile"
                                                class="rounded-circle">
                                        @endempty
                                    </td>
                                    <td>{{ $s->nama_siswa }}</td>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->kelas->tingkat_kelas }}</td>
                                    <td><a class="btn btn-danger" href="{{ route('nilai.year_select', Qs::hash($s->user_id)) }}">Rekap Nilai</a></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </section>

@endsection

