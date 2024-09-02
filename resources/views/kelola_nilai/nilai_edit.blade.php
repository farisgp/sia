
<form method="POST" action="{{ route('nilai.update', [$id_kelas, $id_mapel]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="table table-borderless datatable table-striped">
                <thead>
                    <tr>
                        <th scope="col" rowspan="2">No</th>
                        <th scope="col" rowspan="2">Nama</th>
                        <th scope="col" rowspan="2">NIS</th>
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
            @foreach($nilai->sortBy('kelola.nama') as $mk)
                <tr>
                    <th scope="row">{{ $no++ }}</th>
                    <td>{{ $mk->kelola->siswa->nama_siswa }}</td>
                    <!-- <td>{{$mk->kelola->siswa ? $mk->kelola->siswa->nis : 'N/A'}}</td> -->
                    <td>{{$mk->kelola->siswa->nis}}</td>

                    <td><input title="LM 1" min="0" max="100" class="text-center" name="lm1_{{ $mk->id }}" value="{{ $mk->lm1 }}" type="number"></td>
                    <td><input title="LM 2" min="0" max="100" class="text-center" name="lm2_{{ $mk->id }}" value="{{ $mk->lm2 }}" type="number"></td>
                    <td><input title="LM 3" min="0" max="100" class="text-center" name="lm3_{{ $mk->id }}" value="{{ $mk->lm3 }}" type="number"></td>
                    <td><input title="LM 4" min="0" max="100" class="text-center" name="lm4_{{ $mk->id }}" value="{{ $mk->lm4 }}" type="number"></td>
                    <td><input title="LM 5" min="0" max="100" class="text-center" name="lm5_{{ $mk->id }}" value="{{ $mk->lm5 }}" type="number"></td>
                    <td><input title="LM 6" min="0" max="100" class="text-center" name="lm6_{{ $mk->id }}" value="{{ $mk->lm6 }}" type="number"></td>
                    <td name="rata_lm_{{ $mk->id }}" value="{{ $mk->rata_lm }}">{{ ($mk->lm1 + $mk->lm2 + $mk->lm3 + $mk->lm4 + $mk->lm5 + $mk->lm6) / 6 }}</td>
                    <td><input title="TES" min="0" max="100" class="text-center" name="tes_{{ $mk->id }}" value="{{ $mk->tes }}" type="number"></td>
                    <td><input title="NON TES" min="0" max="100" class="text-center" name="non_tes_{{ $mk->id }}" value="{{ $mk->non_tes }}" type="number"></td>
                    <td name="rata_sas_{{ $mk->id }}" value="{{ $mk->rata_sas }}">{{ ($mk->tes + $mk->non_tes) / 2 }}</td>
                    <td name="na_{{ $mk->id }}" value="{{ $mk->na }}">{{ (($mk->lm1 + $mk->lm2 + $mk->lm3 + $mk->lm4 + $mk->lm5 + $mk->lm6) / 6 + ($mk->tes + $mk->non_tes) / 2) / 2 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="col-sm-10 ">
        <button type="submit" class="btn btn-primary" title="Simpan Nilai"><i
                class="bi bi-save"></i> Simpan</button>
    </div>
</form>
            