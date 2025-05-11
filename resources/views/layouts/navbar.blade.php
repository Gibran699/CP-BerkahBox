<nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top"
    style="box-shadow: 1px 6px 8px rgba(0, 0, 0, 0.1);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="../../icon/logonavbar.png" height="50" width="50" style="margin-right: 10px;" alt="Logo">
            <span> Masjid Berkah-Box</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Beranda</a>
                </li>
                <!-- Dropdown Profil -->
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="profilDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                        <li><a class="dropdown-item" href="{{ route('profil.sejarah') }}">Sejarah</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.visimisi') }}">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="{{ route('profil.struktur') }}">Struktur Organisasi</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('donasi.donasi') }}">Donasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('galeri.galeri') }}">Galeri</a>
                </li>
                <!-- Dropdown Form -->
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="formDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Form
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="formDropdown">
                        <li><a class="dropdown-item" href="{{ route('form.pengajuan') }}">Pengajuan Donasi</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Dropdown untuk Dashboard dan Logout -->
            @if (auth()->check())
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="userDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            @if (auth()->user()->role === 'admin')
                                <a class="dropdown-item" href="{{ route('admin.admin') }}">Dashboard Admin</a>
                            @else
                                <a class="dropdown-item" href="{{ route('user.dashboard') }}">Dashboard User</a>
                            @endif
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a class="btn btn-success" href="{{ route('auth.login') }}">Login</a>
            @endif
        </div>
    </div>
</nav>
