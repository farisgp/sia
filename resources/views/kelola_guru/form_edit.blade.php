@extends('admin.app')
@section('content')
@php
$ar_gender = ["L","P"];
$ar_jenisguru = ['Kepala Sekolah', 'Guru Kelas', 'Guru Mata Pelajaran'];
$ar_mapel = App\Models\MataPelajaran::all();
$ar_agama = App\Models\Agama::all();
$ar_kelas = App\Models\Kelas::all();
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
                    <h5 class="card-title">Form Edit Guru</h5>
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
                    <form method="POST" class="row g-3" action="{{ route('data_guru.update', $row->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-4">
                            <label class="col-sm-3 col-form-label">Nama</label>
                                <input type="text" name="nama_guru" value="{{ $row->nama_guru }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-3 col-form-label">NIP</label>
                                <input type="text" name="nip" value="{{ $row->nip }}" class="form-control">
                        </div>
                        
                        
                        <div class="col-md-4">
                            <label class="col-sm-9 col-form-label">Pangkat/Gol. Ruang</label>
                                <input type="text" name="jabatan" value="{{ $row->jabatan }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="col-sm-5 col-form-label">Jenis Guru<span class="required"> *</span></label>
                            <select class="form-select  @error('jenis_guru') is-invalid @enderror" name="jenis_guru" onchange="toggleMapelField(this)">
                                <option selected disabled>{{$row->jenis_guru}}</option>
                                @php
                                    $kepalaSekolahExists = App\Models\Guru::where('jenis_guru', 'Kepala Sekolah')->exists();
                                @endphp
                                @foreach($ar_jenisguru as $jg)
                                @php $cek1 = ($jg == $row->jenis_guru) ? 'selected' : ''; @endphp

                                    <option value="{{$jg}}" {{ $cek1 }} {{ $kepalaSekolahExists && $jg == 'Kepala Sekolah' ? 'disabled' : '' }}>{{$jg}}</option>
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
                            @if($row->mata_pelajaran)
                                <option disabled selected>Guru {{ $row->mata_pelajaran->nama_mapel }}</option>
                            @else
                                <option disabled selected>-- Pilih Mata Pelajaran --</option>
                            @endif
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
                            @php
                                $id_kelas = json_decode($row->id_kelas);
                            @endphp

                            @foreach($id_kelas as $id)
                                @php
                                    // Ambil objek kelas berdasarkan ID
                                    $kelas = \App\Models\Kelas::find($id);
                                @endphp
                                <option disabled selected>{{ $kelas->tingkat_kelas }}</option>
                            @endforeach
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
                            <label for="inputNumber" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="foto">
                                @if (!empty($row->foto))
                                    <img src="{{ url('admin/img') }}/{{ $row->foto }}" width="10%"
                                        class="img-thumbnail">
                                    <br />{{ $row->foto }}
                                @endif
                            </div>
                        </div>
                        <fieldset class="col-md-4">
                            <legend class="col-form-label pt-0">Jenis Kelamin</legend>
                            <div class="col-sm-10">
                                @foreach($ar_gender as $gender)
                                    @php $cek = ($gender == $row->jenis_kelamin) ? 'checked' : ''; @endphp
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" 
                                            value="{{ $gender }}" {{ $cek }}>
                                        <label class="form-check-label" for="gridRadios1">
                                            {{ $gender }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </fieldset>
                        <div class="col-md-4">
                            <label class="col-sm-6 col-form-label">Alamat</label>
                                <input type="text" name="alamat" value="{{ $row->alamat }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="col-form-label">Kontak</label>
                            <div class="col-sm-10">
                                <input type="number" name="kontak" value="{{ $row->kontak }}" class="form-control">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10 ">
                                <button type="submit" class="btn btn-primary" title="Simpan Perubahan"><i
                                        class="bi bi-save"></i> Update</button>
                            </div>
                        </div>

                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>
    </div>
</section>
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

</script>

@endsection
