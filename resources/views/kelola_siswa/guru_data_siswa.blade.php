@extends('admin.app')
@section('content')
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Daftar Siswa</h5>
                <br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="text-end">
                    <a target="_blank" href="{{route('generatePDFSiswa')}}" title="Ekspor Nilai PDF" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"> PDF</i></a>&nbsp;
                </div>
                <table class="table table-borderless datatable datatable table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIS</th>
                            <th scope="col">NISN</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kontak Ortu</th>
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
                                    <td>{{ $row->jenis_kelamin }}</td>
                                    <td>{{ $row->tanggal_lahir }}</td>
                                    <td>{{ $row->agama->agama }}</td>
                                    <td>{{ $row->kelas->tingkat_kelas  }}</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ $row->kontak_ortu }}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('body').on('click', '.btnDelete', function(e) {
            e.preventDefault();
            var action = $(this).data('action');
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Yakin'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#formDelete').attr('action', action);
                    $('#formDelete').submit();
                }
            })
        })
    </script>
@endsection
