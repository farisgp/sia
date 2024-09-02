@extends('admin.app')
@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    @empty($guru->foto)
                        <img src="{{ url('admin/img/nophoto.png') }}" style="max-width:60%; max-height:60%" alt="Profile">
                    @else
                        <img src="{{ url('admin/img') }}/{{ $guru->foto }}" style="max-width:60%; max-height:60%" alt="Profile">
                    @endempty
                </div>
            </div>

        </div>

        <div class="col-xl-8">

        <div class="card">
            <div class="card-body pt-3">
            <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile</h5>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nama </div>
                    <div class="col-lg-9 col-md-8">{{ $guru->nama_guru }}</div>
                </div>
                
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIP</div>
                    <div class="col-lg-9 col-md-8">{{ $guru->nip }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Jenis Kelamin </div>
                    <div class="col-lg-9 col-md-8">{{ $guru->jenis_kelamin }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pangkat/Gol. Ruang</div>
                    <div class="col-lg-9 col-md-8">{{ $guru->jabatan }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Jenis Guru</div>
                    <div class="col-lg-9 col-md-8">{{ $guru->jenis_guru }}</div>
                </div>  
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Mengajar Kelas</div>
                    <div class="col-lg-9 col-md-8">
                        @foreach(json_decode($guru->id_kelas) as $kelas_id)
                            @php
                                $kelas = App\Models\Kelas::find($kelas_id);
                            @endphp
                            @if($kelas)
                            {{ $kelas->tingkat_kelas . ',' }}
                            @endif
                        @endforeach</div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8">{{ $guru->alamat }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Kontak</div>
                    <div class="col-lg-9 col-md-8">{{ $guru->kontak }}</div>
                </div>

                </div>
                </div>

            </div><!-- End Bordered Tabs -->

            </div>
        </div>

        </div>
    </div>
</section>
@endsection
