@php 
use App\Helpers\Qs; 
@endphp
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="icon bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
    @auth
        @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a href={{ url('/data_guru') }} class="nav-link {{ request()->is('data_guru*') ? 'active' : '' }}">
                <i class="icon bi bi-person-lines-fill"></i><span>Master Data Guru</span>
            </a>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed {{ request()->is('data_siswa*') ? 'active' : '' }}" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="icon bi bi-person-lines-fill"></i><span>Master Data Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a href="{{ route('data_siswa.create')}}" class="{{ request()->routeIs('data_siswa.create') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>Tambah Siswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.promotion') }}" class="{{ request()->routeIs('siswa.promotion') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>Kenaikan Kelas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswa.graduate')}}" class="{{ request()->routeIs('siswa.graduate') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>Kelulusan
                        </a>
                    </li>
                @foreach(App\Models\Kelas::orderBy('tingkat_kelas')->get() as $c)
                    <li class="nav-item">
                        <a href="{{ route('siswa.index', ['id_kelas' => $c->id]) }}" class="{{ request()->routeIs('siswa.index') && request()->id_kelas == $c->id ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>{{ $c->tingkat_kelas }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <li class="nav-item">
            <a   href={{ url('/kelola_user') }} class="nav-link {{ request()->is('kelola_user*') ? 'active' : '' }}">
                <i class="icon bi bi-person-lines-fill"></i><span>Kelola User</span>
            </a>
        </li>
        <li class="nav-item">
                <a   href={{ route('nilai.bulk_select') }} class="nav-link {{ request()->is('mata-pelajaran*') ? 'active' : '' }}">
                    <i class="icon bi bi-journal-text"></i><span>Nilai Siswa</span>
                </a>
            </li>
        <!-- End Components Nav -->
        
        <li class="nav-item">
            <a   href={{ url('/jadwal') }} class="nav-link {{ request()->is('jadwal*') ? 'active' : '' }}">
                <i class="icon bi bi-menu-button-wide"></i><span>Jadwal Pelajaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a   href={{ route('settings') }} class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                <i class="icon bi bi-gear"></i><span>Semester System</span>
            </a>
        </li><!-- End Components Nav -->
        @elseif((auth()->user()->role == 'guru') && (auth()->user()->guru->jenis_guru == 'Kepala Sekolah'))
        <li class="nav-item">
            <a href={{ route('siswa.index_guru') }} class="nav-link {{ request()->is('data_guru*') ? 'active' : '' }}">
                <i class="icon bi bi-person-lines-fill"></i><span>Master Data Guru</span>
            </a>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed {{ request()->is('data_siswa*') ? 'active' : '' }}" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="icon bi bi-person-lines-fill"></i><span>Master Data Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a href="{{ route('siswa.kepsek_show_graduated')}}" class="{{ request()->routeIs('siswa.kepsek_show_graduate') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>Kelulusan
                        </a>
                    </li>
                @foreach(App\Models\Kelas::orderBy('tingkat_kelas')->get() as $c)
                    <li class="nav-item">
                        <a href="{{ route('siswa.index_siswa', ['id_kelas' => $c->id]) }}" class="{{ request()->routeIs('siswa.index') && request()->id_kelas == $c->id ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>{{ $c->tingkat_kelas }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
        @elseif(auth()->user()->role == 'guru')
        <li class="nav-item">
            <a class="nav-link collapsed {{ request()->is('data_siswa*') ? 'active' : '' }}" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
                <i class="icon bi bi-person-lines-fill"></i><span>Daftar Siswa</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    @php
                    $user = auth()->user();
                    $idKelasGuru = [];

                    if ($user->guru) {
                        $idKelasGuru = json_decode($user->guru->id_kelas);
                    }
                    
                    @endphp
                    @foreach($idKelasGuru as $kelas)
                        <li class="nav-item">
                            <a href="{{ route('siswa.index_siswa', ['id_kelas' => $kelas]) }}" class="{{ request()->routeIs('siswa.index') && request()->id_kelas == $kelas ? 'active' : '' }}">
                                <i class="bi bi-circle"></i>Kelas {{ $kelas }}
                            </a>
                        </li>
                    @endforeach
            </ul>
        </li>
        <li class="nav-item">
                <a   href={{ route('nilai.index') }} class="nav-link {{ request()->is('mata-pelajaran*') ? 'active' : '' }}">
                    <i class="icon bi bi-person-lines-fill"></i><span>Nilai Siswa</span>
                </a>
            </li><!-- End Components Nav -->
        
        <li class="nav-item">
            <a   href={{ route('jadwal.guru', ['id' => auth()->user()->id]) }} class="nav-link {{ request()->is('jadwal*') ? 'active' : '' }}">
                <i class="icon bi bi-menu-button-wide"></i><span>Jadwal Pelajaran</span>
            </a>
        </li>
        
        @elseif(auth()->user()->role == 'siswa')
        
        <li class="nav-item">
                <a href="{{ route('nilai.year_select', Qs::hash(auth()->user()->id)) }}" class="nav-link {{ in_array(Route::currentRouteName(), ['nilai.show', 'nilai.year_selector']) ? 'active' : '' }}">
                    <i class="icon bi bi-person-lines-fill"></i><span>Nilai</span>
                </a>
            </li><!-- End Components Nav -->
            <!-- <li class="nav-item">
                <a   href={{ url('/presensi') }} class="nav-link {{ request()->is('presensi*') ? 'active' : '' }}">
                    <i class="icon bi bi-person-lines-fill"></i><span>Presensi Siswa</span>
                </a>
            </li> -->
        <li class="nav-item">
            <a   href={{ route('jadwal.siswa', ['id' => auth()->user()->id]) }} class="nav-link {{ request()->is('jadwal*') ? 'active' : '' }}">
                <i class="icon bi bi-menu-button-wide"></i><span>Jadwal Pelajaran</span>
            </a>
        </li>
        @endif
    @endauth

    </ul>

</aside>
