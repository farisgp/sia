
<table cellpadding="1" cellspacing="0" border="1">
    <thead>
        <tr>
            <th  >No</th>
            <th  >Foto</th>
            <th  >Nama</th>
            <th  >NIS</th>
            <th  >NISN</th>
            <th  >Kelas</th>
            <th  >Tahun Lulus</th>
        </tr>
    </thead>
    <tbody>
        @php $no= 1; @endphp
        @foreach ($siswa as $row)
        
        <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td style="text-align: center;">
                        @empty($row->foto)
                            <img src="{{ public_path('admin/img/nophoto.png') }}" style="display: block; margin: 0 auto; max-width: 200px; max-height: 200px;" width="50%" alt="Profile"
                                class="rounded-circle">
                        @else
                            <img src="{{ public_path('admin/img') }}/{{ $row->foto }}" style="display: block; margin: 0 auto; max-width: 200px; max-height: 200px;" width="50%"  alt="Profile"
                                class="rounded-circle">
                        @endempty
                    </td>
                    <td>{{ $row->nama_siswa }}</td>
                    <td>{{ $row->nis }}</td>
                    <td>{{ $row->nisn  }}</td>
                    <td width="10%">{{ $row->kelas->tingkat_kelas  }}</td>
                    <td width="20%">{{ $row->tahun_lulus }}</td>
                </tr>
        @endforeach
    </tbody>
</table>
