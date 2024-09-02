<form id="sellNilai" method="POST" class="row g-3" action="{{ route('nilai.selector') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-md-3">
        <label class="col-sm-3 col-form-label">Kelas</label>
        <select class="form-select @error('id_kelas') is-invalid @enderror" id="id_kelas" name="id_kelas">
            <option selected disabled>-- Pilih Kelas --</option>
            @php
            $user = auth()->user();
            $idKelasGuru = [];

            if ($user->guru) {
                $idKelasGuru = json_decode($user->guru->id_kelas);
            }
            
            @endphp
            @foreach($idKelasGuru as $kelas_id)
                @php
                    $kelas = $kelas_id;
                @endphp
                    @if($kelas)
                        <option value="{{ $kelas }}" {{ $selected && $kelas == 'id_kelas' ? 'selected' : '' }}>{{ 'Kelas '.$kelas }}</option>
                    @endif
            @endforeach
        </select>
        @error('id_kelas')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-3">
        <label class="col-sm-9 col-form-label">Mata Pelajaran<span class="required"> *</span></label>
        <select class="form-select @error('id_mapel') is-invalid @enderror" id="id_mapel" name="id_mapel">
            <option selected disabled>-- Pilih Mata Pelajaran --</option>
            @php
                // Dapatkan semua ID mata pelajaran dari tabel mata_pelajaran
                $id_mapel_all = \App\Models\MataPelajaran::all();

                // Dapatkan ID mata pelajaran yang sudah dipilih oleh guru dari tabel guru
                $id_mapel_selected = auth()->user()->guru->pluck('id_mapel');
            @endphp
            @if(auth()->user()->guru->jenis_guru == "Guru Mata Pelajaran")
                <option value="{{ auth()->user()->guru->id_mapel }}">{{ auth()->user()->guru->mata_pelajaran->nama_mapel }}</option>
            @else
                @foreach($id_mapel_all as $mapel)
                    @unless($id_mapel_selected->contains($mapel->id))
                        <!-- Jika ID mata pelajaran belum dipilih oleh guru, tampilkan sebagai opsi -->
                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                    @endunless
                @endforeach
            @endif
        </select>
        @error('id_mapel')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <div class="col-md-6">
        <label class="col-sm-2 col-form-label"> </label>
        <div class="col-sm-10 mt-3">
            <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                    class="bi bi-save"></i> Kelola Nilai</button>&nbsp;
        <!-- <a class="btn btn-danger"  href=" {{ route('nilai.bulk_select') }}">
            <i class="bi bi-file-earmark-pdf">PDF</i>
        </a>&nbsp; -->
        <a class="btn btn-secondary" title="Download Rekap Nilai" href=" {{ route('nilai.bulk_select') }}">
            <i class="bi bi-download"> Download Rekap Nilai</i>
        </a>&nbsp;
        <!-- <a class="btn btn-success" title="Ekspor Nilai Excel" href="{{ route('nilai.bulk_select') }}">
            <i class="bi bi-file-earmark-excel">EXCEL</i>
        </a>&nbsp; -->
        </div>
    </div>

</form>