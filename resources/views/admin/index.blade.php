@extends('admin.app')
@section('content')
</div><!-- End Page Title -->
          <div class="row">
            <div class="col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Total Siswa</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    </div>
                    <div class="ps-6">
                      <h3>{{ $totalSiswa }}</h3>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Total Guru</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    </div>
                    <div class="ps-6">
                      <h3>{{ $totalGuru }}</h3>
                    </div>
                  </div>
                </div>

              </div>
            </div>
        </div>
@endsection