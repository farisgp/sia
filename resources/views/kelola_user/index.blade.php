@extends('admin.app')
@section('content')
    <!-- Recent Sales -->
    @if (auth()->user()->role == 'admin')
        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Kelola Users</h5>
                    <br>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <table class="table table-borderless datatable table-striped" style="border:1;">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no= 1; @endphp
                            @foreach ($kelola as $row)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->role }}</td>
                                    <td width="20%">
                                        <form method="POST" id="formDelete">
                                            @csrf
                                            @method('DELETE')

                                            <!--<a class="btn btn-info btn-sm" title="Detail Users"-->
                                            <!--    href=" {{ route('kelola_user.show', $row->id) }}">-->
                                            <!--    <i class="bi bi-eye"></i>-->
                                            <!--</a>-->
                                            &nbsp;  
                                                    <a class="btn btn-warning btn-sm" title="Edit Data User" href="{{ route('kelola_user.edit', $row->id) }}">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                            &nbsp;
                                            <button type="submit"
                                                data-action="{{ route('kelola_user.destroy', $row->id) }}"
                                                class="btn btn-danger btn-sm btnDelete" title="Hapus Users">
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
    @endif
@endsection
