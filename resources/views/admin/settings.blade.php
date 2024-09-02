@extends('admin.app')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Semester System</h5>
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
                        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="tahun_ajaran" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Choose..." required name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                                        <option value=""></option>
                                        @for($y = date('Y', strtotime('- 3 years')); $y <= date('Y', strtotime('+ 1 years')); $y++)
                                            @php
                                                $tahun_ajaran = ($y - 1) . '-' . $y;
                                                $label = ($y % 2 == 0) ? 'Genap' : 'Ganjil';
                                                $semester = ($y % 2 == 0) ? 'Ganjil' : 'Genap'; // Menentukan semester
                                            @endphp
                                            <option {{ ('tahun_ajaran' == (($semester).'-'.($tahun_ajaran))) ? 'selected' : '' }}>
                                                {{ $semester }}-{{ $tahun_ajaran }}
                                            </option>
                                        @endfor
                                        <!-- @for($y=date('Y', strtotime('- 3 years')); $y<=date('Y', strtotime('+ 1 years')); $y++)
                                            <option {{ ('tahun_ajaran' == (($y-=1).'-'.($y+=1))) ? 'selected' : '' }}>{{ ($y-=1).'-'.($y+=1) }}</option>
                                        @endfor -->
                                    </select>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10 ">
                                    <button type="submit" class="btn btn-primary" title="Simpan Stakeholder"><i
                                            class="bi bi-save"></i> Simpan</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection
