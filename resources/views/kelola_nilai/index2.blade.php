@extends('admin.app')
@section('content')
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Input Nilai</h5>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <br>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                            <table class="table table-borderless datatable">
                                <thead>
                                    <tr>
                                        <th scope="col" rowspan="2">No</th>
                                        <th scope="col" rowspan="2">Kelas</th>
                                        <th scope="col" rowspan="2">Nama</th>
                                        <th scope="col" rowspan="2">NIS</th>
                                        <th scope="col" rowspan="2">Mata Pelajaran</th>
                                        <th scope="col" colspan="6">Sumatif Lingkup Materi</th>
                                        <th scope="col" rowspan="2">Rata Rata</th>
                                        <th scope="col" colspan="3">Sumatif Akhir Semester</th>
                                        <th scope="col" rowspan="2">Nilai Akhir Semester (NA)</th>
                                    </tr>
                                    <tr>
                                        <th scope="col">LM 1</th>
                                        <th scope="col">LM 2</th>
                                        <th scope="col">LM 3</th>
                                        <th scope="col">LM 4</th>
                                        <th scope="col">LM 5</th>
                                        <th scope="col">LM 6</th>
                                        <th scope="col">Tes</th>
                                        <th scope="col">Non Tes</th>
                                        <th scope="col">Rata Rata</th>
                                    </tr>
                                </thead>
                            <tbody>
                            @php $no= 1; @endphp
                            @foreach ($siswa as $row2)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th> 
                                    @php 
                                    $nilai = \App\Models\Nilai::where('id_mapel', $row->id)
                                            ->where('id_siswa', $row2->id)
                                            ->first();  
                                    @endphp                            
                                    <td>
                                        <input type="text" readonly name="kelas"
                                            style="width: 60px; border: none; outline: none;"
                                            value="{{ $row2->kelas->tingkat_kelas }}">
                                        <input type="hidden" name="id_siswa[]" value="{{ $row2->id }}">
                                    </td>
                                    <td>
                                        <input type="text" readonly name="siswa"
                                            style="border: none; outline: none;"
                                            value="{{ $row2->nama_siswa }}">
                                    </td>
                                    <td>
                                        <input type="text" readonly name="siswa"
                                            style="border: none; outline: none;"
                                            value="{{ $row2->nis }}">
                                    </td>
                                    <td>
                                        <input type="text" readonly
                                            style="width: 60px; border: none; outline: none;" name="mata_pelajaran"
                                            value="{{ $row->nama_mapel }}">
                                        <input type="hidden" name="id_mapel[]" value="{{ $row->id }}">
                                    </td>
                                    <td><span class="editable" data-id="{{ $row2->id }}" data-field="lm1">{{ $nilai->lm1 ?? '' }}</span></td>
                                    <td><span class="editable" data-id="{{ $row2->id }}" data-field="lm2">{{ $nilai->lm2 ?? '' }}</span></td>
                                    <td><span class="editable" data-id="{{ $row2->id }}" data-field="lm3">{{ $nilai->lm3 ?? '' }}</span></td>
                                    <td><span class="editable" data-id="{{ $row2->id }}" data-field="lm4">{{ $nilai->lm4 ?? '' }}</span></td>
                                    <td><span class="editable" data-id="{{ $row2->id }}" data-field="lm5">{{ $nilai->lm5 ?? '' }}</span></td>
                                    <td><span class="editable" data-id="{{ $row2->id }}" data-field="lm6">{{ $nilai->lm6 ?? '' }}</span></td>
                                    <td><input type="text" style="width: 40px;" name="nilai[{{ $row2->id }}][rata_rata_lm]" value=""></td>
                                    <td><input type="text" style="width: 40px;" name="nilai[{{ $row2->id }}][tes]" value=""></td>
                                    <td><input type="text" style="width: 40px;" name="nilai[{{ $row2->id }}][non_tes]" value=""></td>
                                    <td><input type="text" style="width: 40px;" name="nilai[{{ $row2->id }}][rata_rata_sas]" value=""></td>
                                    <td><input type="text" style="width: 40px;" name="nilai[{{ $row2->id }}][nilai_akhir]" value=""></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary btnEdit" data-id="{{ $row2->id }}">Edit</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-sm-10 ">

                                    <a class="btn btn-info" title="Kembali" href=" {{ url('mata-pelajaran') }}">
                                        <i class="bi bi-arrow-left-square"> Kembali</i>
                                    </a>
                                    &nbsp;
                                    <a class="btn btn-info" title="Tambah Nilai" href=" {{ route('nilai.edit', $row->id) }}">
                                        <i class="bi bi-plus"> Tambah Nilai</i>
                                    </a>
                                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // Handle click event on editable column
        $('.editable-col').on('click', function() {
            var id = $(this).find('.editable').data('id');
            var field = $(this).find('.editable').data('field');
            var value = $(this).find('.editable').text();

            // Add your logic to open an input field or a modal for editing
            // Example: openEditModal(id, field, value);
        });
    });
</script>


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
