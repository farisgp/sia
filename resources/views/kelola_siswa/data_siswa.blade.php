@extends('admin.app')
@section('content')
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Master Data Siswa</h5>
                <br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table class="table table-borderless datatable table-striped">
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
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no= 1; @endphp
                        @foreach ($siswa as $row)
                        
                        <tr>
                                    <th>{{ $no++ }}</th>
                                    <td>
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
                                    <td style="width: 90%">
                                        <form method="POST" id="formDelete">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-info btn-sm" title="Detail Siswa"
                                                href=" {{ route('data_siswa.show', $row->id) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            &nbsp;
                                            <a class="btn btn-warning btn-sm" title="Ubah Data Siswa"
                                                href="{{ route('data_siswa.edit', $row->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            &nbsp;
                                            <button type="submit"
                                                data-action="{{ route('data_siswa.destroy', $row->id) }}"
                                                class="btn btn-danger btn-sm btnDelete" title="Hapus Data Siswa">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
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
