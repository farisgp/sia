@extends('admin.app')
@section('content')
dd($request->all());
    <!-- Recent Sales -->
    <div class="col-12">
        <div class="card recent-sales overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Jadwal Pelajaran</h5>
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
                <!-- <br />
                <a href="{{ route('nilai.create') }}" class="btn btn-primary">Tambah</a>
                <br /><br /> -->
                <form method="POST" action="{{ route('nilai.update') }}" enctype="multipart/form-data">
                    @csrf
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
                                <th scope="col" rowspan="2">Aksi</th>
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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Tambah Data Nilai</h5>
                                        <form method="POST" action="{{ route('nilai.store') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="kelas">Kelas</label>
                                                <input type="text" readonly name="kelas" class="form-control" value="{{ $siswa[0]->kelas->tingkat_kelas }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="siswa">Nama Siswa</label>
                                                <input type="text" readonly name="siswa" class="form-control" value="{{ $siswa[0]->nama_siswa }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="nis">NIS</label>
                                                <input type="text" readonly name="nis" class="form-control" value="{{ $siswa[0]->nis }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="mapel">Mata Pelajaran</label>
                                                <select name="mapel" class="form-control">
                                                    @foreach ($matapelajaran as $mapel)
                                                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="lm1">LM 1</label>
                                                <input type="number" name="lm1" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="lm2">LM 2</label>
                                                <input type="number" name="lm2" class="form-control" required>
                                            </div>
                                            <!-- Tambahkan field lain sesuai kebutuhan -->
                                            <button type="submit" class="btn btn-primary">Tambah Data</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary" title="Simpan Nilai">+</button>
                </form>
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
