@extends('admin.app')
@section('content')
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Master Data Guru</h5>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="text-end">
                    <a target="_blank" href="{{route('generatePDFGuru')}}" title="Ekspor Data PDF" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"> PDF</i></a>&nbsp;
                </div>
                <table class="table table-borderless datatable table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Pangkat/Gol. Ruang</th>
                            <th scope="col">Jenis Guru</th>
                            <th scope="col">Mengajar Kelas</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kontak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no= 1; @endphp
                        @foreach ($guru as $row)
                        
                        <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td width="15%">
                                        @empty($row->foto)
                                            <img src="{{ url('admin/img/nophoto.png') }}" width="100%" alt="Profile"
                                                class="rounded-circle">
                                        @else
                                            <img src="{{ url('admin/img') }}/{{ $row->foto }}" width="100%" alt="Profile"
                                                class="rounded-circle">
                                        @endempty
                                    </td>
                                    <td>{{ $row->nama_guru }}</td>
                                    <td>{{ $row->nip }}</td>
                                    <td>{{ $row->jenis_kelamin }}</td>
                                    <td>{{ $row->jabatan }}</td>
                                    <td>{{ $row->jenis_guru}} {{ optional($row->mata_pelajaran)->nama_mapel }}</td>
                                    <td>@foreach(json_decode($row->id_kelas) as $kelas_id)
                                        @php
                                            $kelas = App\Models\Kelas::find($kelas_id);
                                        @endphp
                                        @if($kelas)
                                        {{ $kelas->tingkat_kelas}}
                                        @endif
                                    @endforeach</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ $row->kontak }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
