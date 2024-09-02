
@extends('admin.app')
@section('content')
@php
use App\Helpers\Qs;
$ar_kelas = App\Models\Kelas::all();
$ar_mapel = App\Models\MataPelajaran::all();
@endphp
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Print Nilai Siswa</h5>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @elseif ($message = Session::get('error'))
                            <div class="alert alert-danger">
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
                        <form method="POST" class="row g-3" action="{{ route('nilai.year_select', $id_siswa) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <label class="col-sm-9 col-form-label">Pilih Tahun Ajaran</label>
                                <select required id="year" name="year" data-placeholder="Select Tahun Ajaran" class="form-select">
                                    @foreach($years as $y)
                                        <option value="{{ $y->tahun_ajaran }}">{{ $y->tahun_ajaran }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-4">
                                <label class="col-sm-2 col-form-label"> </label>
                                <div class="col-sm-10 mt-3">
                                    <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                                            class="bi bi-save"></i>Submit</button>
                                </div>
                            </div>

                        </form>
                        
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>

@endsection

