<!-- ======= Header ======= -->
@php
use App\Helpers\Qs;
@endphp
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.html" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">S.I.A</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                @if(auth()->user()->role == 'guru')
                    @empty(auth()->user()->guru->foto)
                        <img src="{{ url('admin/img/nophoto.png') }}" alt="Profile" class="rounded-circle">
                    @else
                        <img src="{{ url('admin/img') }}/{{  auth()->user()->guru->foto }}" alt="Profile" class="rounded-circle">
                    @endempty
                @elseif(auth()->user()->role == 'siswa')
                     @empty(auth()->user()->siswa->foto)
                        <img src="{{ url('admin/img/nophoto.png') }}" alt="Profile" class="rounded-circle">
                    @else
                        <img src="{{ url('admin/img') }}/{{  auth()->user()->siswa->foto }}" alt="Profile" class="rounded-circle">
                    @endempty
                @endif

        <span class="d-none d-md-block dropdown-toggle ps-2">
            
          @if(empty(auth()->user()->username))
            {{ '' }}
            @else
            {{ auth()->user()->username }}
          @endif</span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
                @if(auth()->user()->role == 'guru')
                    @empty(auth()->user()->guru->foto)
                        <img src="{{ url('admin/img/nophoto.png') }}" style="max-width:40%; max-height:40%"alt="Profile" class="rounded-circle">
                    @else
                        <img src="{{ url('admin/img') }}/{{  auth()->user()->guru->foto }}" style="max-width:40%; max-height:40%" alt="Profile" class="rounded-circle">
                    @endempty
                @endif
                @if(auth()->user()->role == 'siswa')
                    @empty(auth()->user()->siswa->foto)
                        <img src="{{ url('admin/img/nophoto.png') }}" style="max-width:40%; max-height:40%" alt="Profile" class="rounded-circle">
                    @else
                        <img src="{{ url('admin/img') }}/{{  auth()->user()->siswa->foto }}" style="max-width:40%; max-height:40%" alt="Profile" class="rounded-circle">
                    @endempty
                @endif
        @auth
          <h6>{{ auth()->user()->username }}</h6>
          <span>{{ auth()->user()->role }}</span>
        @endauth
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        @auth
          @if(auth()->user()->role == 'guru')
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('data_guru.detail', Qs::hash(Qs::findGuruRecord(auth()->user()->id)->id)) }}" >
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('setting') }}" >
              <i class="bi bi-gear"></i>
              <span>Setting</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          @elseif(auth()->user()->role == 'siswa')
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('data_siswa.detail', Qs::hash(Qs::findStudentRecord(auth()->user()->id)->id)) }}" >
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('setting') }}" >
              <i class="bi bi-gear"></i>
              <span>Setting</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          @endif
        @endauth

        <!-- <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-gear"></i>
            <span>Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
            <i class="bi bi-question-circle"></i>
            <span>Need Help?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li> -->

        <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  <i class="bi bi-box-arrow-right"></i>{{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->