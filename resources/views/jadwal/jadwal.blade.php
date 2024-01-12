@extends('admin.app')
@section('content')
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Jadwal Pelajaran</h5>
                <br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <br />
                <a href="{{ route('jadwal.create') }}" class="btn btn-primary">Tambah</a>
                <br /><br />
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Mata Pelajaran</th>
                            <th scope="col">Guru Pengampu</th>
                            <th scope="col">Hari</th>
                            <th scope="col">Pukul</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no= 1; @endphp
                        @foreach ($jadwal as $row)
                        <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $row->kelas->tingkat_kelas }}</td>
                                    <td>{{ $row->mata_pelajaran->nama_mapel }}</td>
                                    <td>{{ $row->guru->nama_guru }}</td>
                                    <td>{{ $row->hari }}</td>
                                    <td>{{ $row->waktu }}</td>
                                    <td width="25%">
                                        <form method="POST" id="formDelete">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-warning btn-sm" title="Ubah Jadwal"
                                                href="{{ route('jadwal.edit', $row->id) }}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            &nbsp;
                                            <button type="submit"
                                                data-action="{{ route('jadwal.destroy', $row->id) }}"
                                                class="btn btn-danger btn-sm btnDelete" title="Hapus Jadwal">
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
