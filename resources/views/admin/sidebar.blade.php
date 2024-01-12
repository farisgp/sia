<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
    @auth
        @if(auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href={{ url('/data_guru') }}>
                <i class="bi bi-person-lines-fill"></i><span>Master Data Guru</span>
            </a>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link" href={{ url('/data_siswa') }}>
                <i class="bi bi-person-lines-fill"></i><span>Master Data Siswa</span>
            </a>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link" href={{ url('/kelola_user') }}>
                <i class="bi bi-person-lines-fill"></i><span>Kelola User</span>
            </a>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link" href={{ url('/jadwal') }}>
                <i class="bi bi-menu-button-wide"></i><span>Jadwal Pelajaran</span>
            </a>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link" href={{ url('/raport') }}>
                <i class="bi bi-journal-text"></i><span>Raport</span>
            </a>
        </li><!-- End Forms Nav -->
        @elseif(auth()->user()->role == 'guru')
        
        <li class="nav-item">
                <a class="nav-link" href={{ url('/mata-pelajaran') }}>
                    <i class="bi bi-person-lines-fill"></i><span>Nilai Siswa</span>
                </a>
            </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link" href={{ url('/jadwal') }}>
                <i class="bi bi-menu-button-wide"></i><span>Jadwal Pelajaran</span>
            </a>
        </li>
        @elseif(auth()->user()->role == 'siswa')
        <li class="nav-item">
                <a class="nav-link" href={{ url('/nilai') }}>
                    <i class="bi bi-person-lines-fill"></i><span>Nilai Siswa</span>
                </a>
            </li><!-- End Components Nav -->
            <li class="nav-item">
                <a class="nav-link" href={{ url('/presensi') }}>
                    <i class="bi bi-person-lines-fill"></i><span>Presensi Siswa</span>
                </a>
            </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link" href={{ url('/jadwal') }}>
                <i class="bi bi-menu-button-wide"></i><span>Jadwal Pelajaran</span>
            </a>
        </li>
        @endif
    @endauth

    </ul>

</aside>
