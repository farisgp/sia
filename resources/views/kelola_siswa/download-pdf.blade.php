
<table cellpadding="1" cellspacing="0" border="1">
    <thead>
        <tr>
            <th  >No</th>
            <th  >Foto</th>
            <th  >Nama</th>
            <th  >NIS</th>
            <th  >NISN</th>
            <th  >Jenis Kelamin</th>
            <th  >Tanggal Lahir</th>
            <th  >Agama</th>
            <th  >Kelas</th>
            <th  >Alamat</th>
            <th  >Kontak Ortu</th>
        </tr>
    </thead>
    <tbody>
        @php $no= 1; @endphp
        @foreach ($siswa as $row)
        
        <tr>
                    <th>{{ $no++ }}</th>
                    <td width="15%">
                        @empty($row->foto)
                            <img src="{{ public_path('admin/img/nophoto.png') }}" width="100%" alt="Profile"
                                class="rounded-circle">
                        @else
                            <img src="{{ public_path('admin/img') }}/{{ $row->foto }}" width="100%" alt="Profile"
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
