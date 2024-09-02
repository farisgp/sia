@php
use App\Helpers\Qs;
$ar_kelas = App\Models\Kelas::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp
<table cellpadding="1" cellspacing="0" class="mb-4">
    <tr class="text-center">
        <th colspan="7" >REKAP NILAI SEMESTER</th>
    </tr>
    <tr>
        <td style="width:10%"><strong>NAMA</strong></td>
        <td style="width:1%">:</td>
        <td style="width:30%">{{ strtoupper($sr->nama_siswa) }}</td>
        <td style="width:10%"></td>

        <td style="width:25%"><strong>TAHUN PELAJARAN</strong></td>
        <td style="width:1%">:</td>
        <td>{{ $tahun_ajaran }} </td>
    </tr>
    <tr>
        <td><strong>NIS</strong></td>
        <td>:</td>
        <td>{{ $sr->nis }}</td>
        <td></td>
        <td><strong>ALAMAT SEKOLAH</strong></td>
        <td>:</td>
        <td>Jl. Sijeruk - Sragi, Desa Sijeruk, Kecamatan Sragi, Kabupaten Pekalongan</td>

    </tr>
    <tr>
        <td><strong>KELAS</strong></td>
        <td>:</td>
        <td>{{ strtoupper($kelas->tingkat_kelas) }}</td>
    </tr>
</table>
</br>
</br>
<table class="mt-4" border="collapse" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">MATA PELAJARAN</th>
        <th colspan="7">Sumatif Lingkup Materi</th>
        <th colspan="3">Sumatif Akhir Semester</th>
        <th rowspan="2">Nilai Akhir Semester (NA)</th>
    </tr>
    <tr>
        <th scope="col">LM 1</th>
        <th scope="col">LM 2</th>
        <th scope="col">LM 3</th>
        <th scope="col">LM 4</th>
        <th scope="col">LM 5</th>
        <th scope="col">LM 6</th>
        <th scope="col">Rata Rata</th>
        <th scope="col">Tes</th>
        <th scope="col">Non Tes</th>
        <th scope="col">Rata Rata</th>
    </tr>
    </thead>

    <tbody>@php $no= 1; @endphp
    @foreach($mata_pelajaran as $sub)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $sub->nama_mapel }}</td>
            @foreach($nilai->where('id_mapel', $sub->id) as $mk)
                <td>{{ ($mk->lm1) ?: ' - ' }}</td>
                <td>{{ ($mk->lm2) ?: '-' }}</td>
                <td>{{ ($mk->lm3) ?: '-' }}</td>
                <td>{{ ($mk->lm4) ?: '-' }}</td>
                <td>{{ ($mk->lm5) ?: '-' }}</td>
                <td>{{ ($mk->lm6) ?: '-' }}</td>
                <td>{{ number_format(
                            ((($mk->lm1)+($mk->lm2)+($mk->lm3)+($mk->lm4)+($mk->lm5)+($mk->lm6))/6), 2
                        )
                        ?: '-' }}
                </td>
                <td>{{ ($mk->tes) ?: '-' }}</td>
                <td>{{ ($mk->non_tes) ?: '-' }}</td>
                <td>{{ ((($mk->tes)+($mk->non_tes))/2) ?: '-' }}</td>
                <td>{{ number_format(((((($mk->lm1)+($mk->lm2)+($mk->lm3)+($mk->lm4)+($mk->lm5)+($mk->lm6))/6) + ((($mk->tes)+($mk->non_tes))/2))/2), 2) ?: '-' }}</td>
                
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>