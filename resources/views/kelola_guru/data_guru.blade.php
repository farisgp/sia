@extends('admin.app')
@section('content')
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Master Data Guru</h5>
                <br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <br />
                <a href="{{ route('data_guru.create') }}" class="btn btn-primary">Tambah</a>
                <br /><br />
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Pengampu ( Mata Pelajaran )</th>
                            <th scope="col">Pengampu ( Guru Kelas )</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Kontak</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Pendidikan</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no= 1; @endphp
                        @foreach ($guru as $row)
                        
                        <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $row->nama_guru }}</td>
                                    <td>{{ $row->nip }}</td>
                                    <td>{{ $row->jenis_kelamin }}</td>
                                    <td>{{ $row->mata_pelajaran->nama_mapel }}</td>
                                    <td>{{ $row->kelas->tingkat_kelas  }}</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>{{ $row->kontak }}</td>
                                    <td>{{ $row->agama->agama }}</td>
                                    <td>{{ $row->pendidikan }}</td>
                                    <td>{{ $row->jabatan }}</td>
                                    <td width="50%">
                                        <form method="POST" id="formDelete">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-warning btn-sm" title="Ubah Data Guru"
                                                href="{{ route('data_guru.edit', $row->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            &nbsp;
                                            <button type="submit"
                                                data-action="{{ route('data_guru.destroy', $row->id) }}"
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
