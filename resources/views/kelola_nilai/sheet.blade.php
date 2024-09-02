@php
use App\Helpers\Qs;
$ar_kelas = App\Models\Kelas::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp
        <div class="table-responsive mt-5">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">MATA PELAJARAN</th>
                        <th colspan="7">Sumatif Lingkup Materi</th>
                        <th colspan="3">Sumatif Akhir Semester</th>
                        <th rowspan="2">Nilai Akhir Semester (NA)</th>
                    </tr>
                    <tr>
                        <th scope="row">LM 1</th>
                        <th scope="row">LM 2</th>
                        <th scope="row">LM 3</th>
                        <th scope="row">LM 4</th>
                        <th scope="row">LM 5</th>
                        <th scope="row">LM 6</th>
                        <th scope="row">Rata Rata</th>
                        <th scope="row">Tes</th>
                        <th scope="row">Non Tes</th>
                        <th scope="row">Rata Rata</th>
                    </tr>
                </thead>

                <tbody>@php $no= 1; @endphp
                @foreach($mata_pelajaran as $sub)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $sub->nama_mapel }}</td>
                        @foreach($nilai->where('id_mapel', $sub->id) as $mk)
                            <td>{{ ($mk->lm1) ?: '-' }}</td>
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
        </div>
            
<div class="text-center mt-3">
    <a target="_blank" href="{{ url('generate-pdf', [Qs::hash($id_siswa), $tahun_ajaran]) }}" title="Ekspor Nilai PDF" class="btn btn-danger"><i class="bi bi-file-earmark-pdf"> PDF</i></a>&nbsp;
    <a target="_blank" href="{{ url('generate-excel', [Qs::hash($id_siswa), $tahun_ajaran]) }}" title="Ekspor Nilai Excel" class="btn btn-success"><i class="bi bi-file-earmark-excel"> Excel</i></a>
</div>