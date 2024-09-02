@extends('admin.app')
@section('content')
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Data Kelulusan</h5>
                <br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="text-end mt-3">
                    <a target="_blank" href="{{route('generatePDFKelulusanSiswa')}}" title="Ekspor Data PDF" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"> PDF</i></a>&nbsp;
                </div>
                <table class="table table-borderless datatable datatable table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIS</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Tahun Lulus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no= 1; @endphp
                        @foreach ($siswa as $row)
                        
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
                                    <td>{{ $row->nama_siswa }}</td>
                                    <td>{{ $row->nis }}</td>
                                    <td>{{ $row->nisn  }}</td>
                                    <td width="10%">{{ $row->kelas->tingkat_kelas  }}</td>
                                    <td width="20%">{{ $row->tahun_lulus }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
