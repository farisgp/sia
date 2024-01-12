@extends('admin.index')
@section('content')
    <!-- Recent Sales -->
    @if (Auth::user()->role == 'admin')
        <!-- Recent Sales -->
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Kelola Presensi</h5>
                    <br>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <br />

                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Isactive</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no= 1; @endphp
                            @foreach ($kelola as $row)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->isactive }}</td>
                                    <td width="15%">
                                        @empty($row->foto)
                                            <img src="{{ url('admin/img/nophoto.png') }}" width="30%" alt="Profile"
                                                class="rounded-circle">
                                        @else
                                            <img src="{{ url('admin/img') }}/{{ $row->foto }}" width="30%" alt="Profile"
                                                class="rounded-circle">
                                        @endempty
                                    </td>
                                    <td width="15%">
                                        <form method="POST" id="formDelete">
                                            @csrf
                                            @method('DELETE')

                                            <a class="btn btn-info btn-sm" title="Detail Users"
                                                href=" {{ route('kelola_user.show', $row->id) }}">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            &nbsp;
                                            <a class="btn btn-warning btn-sm" title="Ubah Users"
                                                href=" {{ route('kelola_user.edit', $row->id) }}">
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
                                    <td width="15%">
                                        <form method="POST" action="{{ route('kelola_user.update', $row->id) }}"
                                            class="mt-2" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <select name="isactive" onchange="this.form.submit()"
                                                class="btn btn-warning btn-sm">
                                                <option class="bg-light">Status</option>
                                                <option value="1" class="bg-light">Accept</option>
                                                <option value="0" class="bg-light">Reject</option>
                                            </select>
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
    @else
        @include('admin.access_denied')
    @endif
@endsection
