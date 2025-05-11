<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.admin') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text">MASJID BERKAH BOX</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @if (auth()->user()->role == 'admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.admin') }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.sejarah') }}">
                <i class="fas fa-history"></i>
                <span>Sejarah Yayasan</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.visimisi') }}">
                <i class="fas fa-bullseye"></i>
                <span>Visi dan Misi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.struktur_yayasan') }}">
                <i class="fas fa-sitemap"></i>
                <span>Struktur Organisasi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.program_donasi') }}">
                <i class="fas fa-hand-holding-heart"></i>
                <span>Program Donasi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.donasi') }}">
                <i class="fas fa-donate"></i>
                <span>Donasi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.donatur') }}">
                <i class="fas fa-users"></i>
                <span>Donatur</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.galeri') }}">
                <i class="fas fa-images"></i>
                <span>Galeri</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.pengajuan') }}">
                <i class="fas fa-file-signature"></i>
                <span>Pengajuan Donasi</span></a>
        </li>

        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.donasi_jemput') }}">
                <i class="fas fa-truck"></i>
                <span>Jemput Donasi</span></a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.laporan_donasi') }}">
                <i class="fas fa-file-alt"></i>
                <span>Laporan Donasi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.laporan_pengeluaran') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Laporan Pengeluaran</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.kontak') }}">
                <i class="fas fa-address-book"></i>
                <span>Kontak</span></a>
        </li>
    @endif

    {{-- donatur --}}
    @if (auth()->user()->role == 'user')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Website Utama</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.riwayatdonasi') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Riwayat Donasi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.donasijemput') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Riwayat Jemput Donasi</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.pengajuanuser') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Riwayat Pengajuan Donasi</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
