<form id="sellNilai" method="POST" class="row g-3" action="{{ route('siswa.promote_selector') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-md-3">
        <label for="kelas_lama" class="col-sm-5 col-form-label">Kelas Lama</label>
        <select class="form-select @error('kelas_lama') is-invalid @enderror" id="kelas_lama" name="kelas_lama">
            <option selected disabled>-- Pilih Kelas Lama--</option>
            @foreach($kelas as $c)
                <option {{ ($selected && $kelas_lama == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->tingkat_kelas }}</option>
            @endforeach
        </select>
        @error('id_kelas')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-3">
        <label for="kelas_baru" class="col-sm-9 col-form-label">Kelas Baru<span class="required"> *</span></label>
        <select class="form-select @error('kelas_baru') is-invalid @enderror" id="kelas_baru" name="kelas_baru">
            <option selected disabled>-- Pilih Kelas Baru--</option>
            @foreach($kelas as $c)
                <option {{ ($selected && $kelas_baru == $c->id) ? 'selected' : '' }} value="{{ $c->id }}">{{ $c->tingkat_kelas }}</option>
            @endforeach
        </select>
        @error('id_kelas')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>


    <div class="col-md-6">
        <label class="col-sm-2 col-form-label"> </label>
        <div class="col-sm-10 mt-3">
            <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                    class="bi bi-save"></i> Kelola Kenaikan</button>&nbsp;
        </div>
    </div>

</form>