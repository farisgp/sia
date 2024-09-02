@extends('admin.app')
@section('content')
@php
$ar_gender = ['L','P'];
$ar_jenisguru = ['Kepala Sekolah', 'Guru Kelas', 'Guru Mata Pelajaran'];
$ar_kelas = App\Models\Kelas::all();
$ar_agama = App\Models\Agama::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Input Data Guru</h5>
                    <br>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" class="row g-3" id="form_guru" action="{{ route('data_guru.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4">
                            <label class="col-sm-4 col-form-label">Nama<span class="required"> *</span></label>
                                <input type="text" name="nama_guru" value="{{ old('nama_guru') }}" 
                                class="form-control @error('nama_guru') is-invalid @enderror">
                                @error('nama_guru')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-2 col-form-label">NIP<span class="required"> *</span></label>
                                <input type="number" name="nip" value="{{ old('nip') }}" 
                                class="form-control @error('nip') is-invalid @enderror">
                                @error('nip')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">Pangkat/Gol. Ruang<span class="required"> *</span></label>
                                <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="form-control @error('jabatan') is-invalid @enderror">
                                @error('jabatan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                        </div>
                        
                        <div class="col-md-4">
                            <label class="col-sm-5 col-form-label">Jenis Guru<span class="required"> *</span></label>
                            <select class="form-select  @error('jenis_guru') is-invalid @enderror" name="jenis_guru" onchange="toggleMapelField(this)">
                                <option selected disabled>-- Pilih Jenis Guru --</option>
                                @php
                                    $kepalaSekolahExists = App\Models\Guru::where('jenis_guru', 'Kepala Sekolah')->exists();
                                @endphp
                                @foreach($ar_jenisguru as $jg)
                                    <option value="{{$jg}}" {{ old('jenis_guru') == $jg ? 'selected' : '' }} {{ $kepalaSekolahExists && $jg == 'Kepala Sekolah' ? 'disabled' : '' }}>{{$jg}}</option>
                                @endforeach
                            </select>
                            @error('jenis_guru')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4" id="mapelField" style="display: none;">
                            <label class="col-sm-5 col-form-label">Mata Pelajaran<span class="required"> *</span></label>
                            <select class="form-select @error('id_mapel') is-invalid @enderror" name="id_mapel">
                                <option disabled selected>-- Pilih Mata Pelajaran --</option>
                                @foreach($ar_mapel as $mpl)
                                @php
                                $sel1 = (old('id_mapel') == $mpl->id)? 'selected':'';
                                @endphp
                                <option value="{{ $mpl->id }}" {{ $sel1 }}>Guru {{ $mpl->nama_mapel }}</option>
                                @endforeach
                            </select>
                            @error('id_mapel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-8" id="mengajarKelasField" style="display: none;">
                            <label class="col-sm-10 col-form-label">Mengajar Kelas<span class="required"> *</span></label>
                            <select class="form-select id_kelas @error('id_kelas') is-invalid @enderror" id="id_kelas" data-placeholder="Pilih Kelas Yang Diampu" name="id_kelas[]" multiple>
                                @foreach($ar_kelas as $kls)
                                @php
                                $sel2 = (old('id_kelas') == $kls->id)? 'selected':'';
                                @endphp
                                <option value="{{ $kls->id }}" {{ $sel2 }}>{{ $kls->tingkat_kelas }}</option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-5 col-form-label">Username<span class="required"> *</span></label>
                                <input type="text" name="username" value="{{ old('username') }}" 
                                class="form-control @error('username') is-invalid @enderror">
                                @error('username')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-5 col-form-label">Password<span class="required"> *</span></label>
                                <input type="password" name="password" value="{{ old('password') }}" 
                                class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                        </div>
                        
                        <fieldset class="col-md-4">
                            <legend class="col-form-label pt-0">Jenis Kelamin<span class="required"> *</span></legend>
                            <div class="col-sm-10">
                                @foreach($ar_gender as $jenis_kelamin)
                                @php
                                    $cek = (old('jenis_kelamin') == $jenis_kelamin)? 'checked':'';
                                @endphp
                                <div class="form-check">
                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror"  type="radio" name="jenis_kelamin" value="{{ $jenis_kelamin }}" {{ $cek }}>
                                    <label class="form-check-label" for="gridRadios1">
                                        {{ $jenis_kelamin }}
                                    </label>
                                </div>
                                @endforeach
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-inline">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </fieldset>
                        <!-- <div class="col-md-4">
                            <label class="col-sm-4 col-form-label">Agama</label>
                                <select class="form-select @error('id_agama') is-invalid @enderror" name="id_agama">
                                    <option selected>-- Pilih Agama --</option>
                                    @foreach($ar_agama as $agm)
                                    @php
                                    $sel2 = (old('id_agama') == $agm->id)? 'selected':'';
                                    @endphp
                                    <option value="{{ $agm->id }}" {{ $sel2 }}>{{ $agm->agama }}</option>
                                    @endforeach
                                </select>
                                @error('id_agama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                        </div> -->
                        <div class="col-md-4">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                                <input class="form-control" type="file" name="foto">
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-4 col-form-label">Alamat</label>
                            <input type="text" name="alamat" value="{{ old('alamat') }}" class="form-control">
                        </div>
                        <!-- <div class="col-md-4">
                            <label class="col-form-label">Pendidikan</label>
                                <input type="text" name="pendidikan" class="form-control">
                        </div> -->
                        
                        
                        
                        <div class="col-md-4">
                            <label class="col-form-label">Kontak</label>
                                <input type="number" name="kontak" class="form-control">
                        </div>
                        
                        

                        <div class="col-md-12">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10 ">
                                <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                                        class="bi bi-save"></i> Simpan</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</section>
<!-- <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Input Data Guru</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('data_guru.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_guru" value="{{ old('nama_guru') }}" 
                                class="form-control @error('nama_guru') is-invalid @enderror">
                                @error('nama_guru')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">NIP</label>
                            <div class="col-sm-10">
                                <input type="text" name="nip" value="{{ old('nip') }}" 
                                class="form-control @error('nip') is-invalid @enderror">
                                @error('nip')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="foto">
                            </div>
                        </div>
                        <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                        <div class="col-sm-10">
                            @foreach($ar_gender as $jk)
                            @php
                                $cek = (old('jk') == $jk)? 'checked':'';
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input @error('jk') is-invalid @enderror"  type="radio" name="jenis_kelamin" value="{{ $jk }}" {{ $cek }}>
                                <label class="form-check-label" for="gridRadios1">
                                    {{ $jk }}
                                </label>
                            </div>
                            @endforeach
                            @error('jk')
                                <div class="invalid-feedback d-inline">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </fieldset>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Pengampu ( Guru Kelas )</label>
                            <div class="col-sm-10">
                                <select class="form-select @error('id_kelas') is-invalid @enderror" name="id_kelas">
                                    <option selected>-- Pilih Kelas --</option>
                                    @foreach($ar_kelas as $kls)
                                    @php
                                    $sel2 = (old('id_kelas') == $kls->id)? 'selected':'';
                                    @endphp
                                    <option value="{{ $kls->id }}" {{ $sel2 }}>{{ $kls->tingkat_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Pengampu ( Guru Mata Pelajaran )</label>
                            <div class="col-sm-10">
                                <select class="form-select @error('id_mapel') is-invalid @enderror" name="id_mapel">
                                    <option selected>-- Pilih Mata Pelajaran --</option>
                                    @foreach($ar_mapel as $mpl)
                                    @php
                                    $sel3 = (old('id_mapel') == $mpl->id)? 'selected':'';
                                    @endphp
                                    <option value="{{ $mpl->id }}" {{ $sel3 }}>{{ $mpl->nama_mapel }}</option>
                                    @endforeach
                                </select>
                                @error('id_mapel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="alamat" style="height: 100px">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kontak</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('kontak') }}" name="kontak" class="form-control @error('kontak') is-invalid @enderror">
                                @error('kontak')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Agama</label>
                            <div class="col-sm-10">
                                <select class="form-select @error('id_agama') is-invalid @enderror" name="id_agama">
                                    <option selected>-- Pilih Agama --</option>
                                    @foreach($ar_agama as $agm)
                                    @php
                                    $sel2 = (old('id_agama') == $agm->id)? 'selected':'';
                                    @endphp
                                    <option value="{{ $agm->id }}" {{ $sel2 }}>{{ $agm->agama }}</option>
                                    @endforeach
                                </select>
                                @error('id_agama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Pendidikan</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('pendidikan') }}" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
                                @error('pendidikan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ old('jabatan') }}" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror">
                                @error('jabatan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10 ">

                                <a class="btn btn-info" title="Kembali" href=" {{ url('kelola_user') }}">
                                    <i class="bi bi-arrow-left-square"> Kembali</i>
                                </a>
                                &nbsp;
                                <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                                        class="bi bi-save"></i>Simpan</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</section> -->

<script type="text/javascript">
    $(document).ready(function() {
        $('selectpicker').selectpicker();

        $('.id_kelas').select2({
            placeholder: "Pilih Kelas Yang Diampu",
            allowClear: true
        });

        $( '#id_kelas' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,

            ajax:{
                
                type:"post",
                delay:250,
                dataType:'integer',
                data:function(params){
                    return{
                        name:params.term,
                        "_token":"{{ csrf_token() }",
                    };
                },

                processResults:function(data){
                    return{
                        result: $.map(data, function(item){
                            return{
                                id:item.id,
                                text:item.title,
                            }
                        })
                    }
                }
            }
        } );
    });

    $('.id_kelas').select2({
            placeholder: "Pilih Kelas Yang Diampu",
            allowClear: true
    });

    $( '#id_kelas' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: false,
    });
    
    function toggleMapelField(select) {
        var mapelField = document.getElementById("mapelField");
        var mengajarKelasField = document.getElementById("mengajarKelasField");
        var selectedValue = select.value;

        
        if (selectedValue === "Guru Mata Pelajaran") {
            mapelField.style.display = "block";
            mengajarKelasField.style.display = "block";
            $(document).on("submit", function(){
                mapelField.style.display = "block";
                mengajarKelasField.style.display = "block";
            });
        } 
        else if (selectedValue === "Guru Kelas") {
            mapelField.style.display = "none";
            mengajarKelasField.style.display = "block";
            $(document).on("submit", function(){
                mengajarKelasField.style.display = "block";
            });
        } 
        else {
            mapelField.style.display = "none";
            mengajarKelasField.style.display = "none";
        }
    }
    // function showmapelField() {
    //     var mapelField = document.getElementById("mapelField");
    //     mapelField.style.display = 'block';
    // }
    // function showmengajarKelasField() {
    //     var mengajarKelasField = document.getElementById("mengajarKelasField");
    //     mengajarKelasField.style.display = 'block';
    // }

</script>

@endsection
