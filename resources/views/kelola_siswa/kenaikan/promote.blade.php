<form method="post" action="{{ route('siswa.promote', [$kelas_lama, $kelas_baru]) }}">
    @csrf
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Nama</th>
            <th>Tahun Ajaran</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($siswa->sortBy('kelola.nama') as $sr)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><img class="rounded-circle" style="height: 30px; width: 30px;" src="{{ $sr->foto }}" alt="img"></td>
                <td>{{ $sr->nama_siswa }}</td>
                <td>{{ $sr->tahun_ajaran }}</td>
                <td>
                    <select class="form-control select" name="p-{{$sr->id}}" id="p-{{$sr->id}}">
                        <option value="P">Promote</option>
                        <option value="D">Don't Promote</option>
                    </select>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center mt-3">
        <button class="btn btn-success"><i class="icon-stairs-up mr-2"></i> Promote Students</button>
    </div>
</form>