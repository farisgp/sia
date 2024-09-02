
<table cellpadding="1" cellspacing="0" border="1">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Foto</th>
            <th scope="col">Nama</th>
            <th scope="col">NIP</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Pangkat/Gol. Ruang</th>
            <th scope="col">Jenis Guru</th>
            <th scope="col">Mengajar Kelas</th>
            <th scope="col">Alamat</th>
            <th scope="col">Kontak</th>
        </tr>
    </thead>
    <tbody>
        @php $no= 1; @endphp
        @foreach ($guru as $row)
        
        <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td width="15%">
                        @empty($row->foto)
                            <img src="{{ public_path('admin/img/nophoto.png') }}" width="100%" alt="Profile"
                                class="rounded-circle">
                        @else
                            <img src="{{ public_path('admin/img') }}/{{ $row->foto }}" width="100%" alt="Profile"
                                class="rounded-circle">
                        @endempty
                    </td>
                    <td>{{ $row->nama_guru }}</td>
                    <td>{{ $row->nip }}</td>
                    <td>{{ $row->jenis_kelamin }}</td>
                    <td>{{ $row->jabatan }}</td>
                    <td>{{ $row->jenis_guru}} {{ optional($row->mata_pelajaran)->nama_mapel }}</td>
                    <td>@foreach(json_decode($row->id_kelas) as $kelas_id)
                        @php
                            $kelas = App\Models\Kelas::find($kelas_id);
                        @endphp
                        @if($kelas)
                        {{ $kelas->tingkat_kelas}}
                        @endif
                    @endforeach</td>
                    <td>{{ $row->alamat }}</td>
                    <td>{{ $row->kontak }}</td>
                </tr>
        @endforeach
    </tbody>
</table>
