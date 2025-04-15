<style>
    /* Sidebar default: tersembunyi */
    #sidebarMenu {
        position: fixed;
        top: 0;
        left: -250px;
        height: 100vh;
        width: 250px;
        background-color: #343a40;
        z-index: 1000;
        overflow-y: auto;
        transition: left 0.3s ease;
    }

    #sidebarMenu.active {
        left: 0;
    }

    #content-wrapper {
        transition: margin-left 0.3s ease;
        margin-left: 0;
    }

    #content-wrapper.sidebar-active {
        margin-left: 250px;
    }

    #toggleSidebar {
        z-index: 1100;
        position: relative;
        cursor: pointer;
    }


    footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        background-color: #fff;
        z-index: 2;
    }

    @media (max-width: 768px) {
        #sidebarMenu {
            width: 30%;
            left: -100%;
        }

        #sidebarMenu.active {
            left: 0;
        }

        #content-wrapper.sidebar-active {
            margin-left: 0;
        }

        #toggleSidebar {
            z-index: 1100;
            position: relative;
            cursor: pointer;
            left: 30%;

        }

    }

    @media (max-width: 576px) {
        #sidebarMenu {
            width: 25%;
            left: -50%;
        }

        #sidebarMenu.active {
            left: 0;
        }

        #content-wrapper.sidebar-active {
            margin-left: 0;
        }

        #toggleSidebar {
            z-index: 1100;
            position: relative;
            cursor: pointer;
            left: 25%;

        }

    }
</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.navbaradmin')
                <div class="container-fluid">
                    <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1>
                    @yield('contents')
                </div>
            </div>
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="../../vendor/jquery/jquery.min.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../../vendor/chart.js/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggleSidebar = document.getElementById('toggleSidebar'); // Ikon bars
                const sidebarMenu = document.getElementById('sidebarMenu'); // Sidebar
                const contentWrapper = document.getElementById('content-wrapper'); // Konten utama

                // Cek status sidebar dari LocalStorage saat halaman dimuat
                const sidebarState = localStorage.getItem('sidebarState');
                if (sidebarState === 'active') {
                    sidebarMenu.classList.add('active');
                    contentWrapper.classList.add('sidebar-active');
                }

                // Toggle sidebar ketika ikon bars ditekan
                toggleSidebar.addEventListener('click', function(e) {
                    e.preventDefault();
                    sidebarMenu.classList.toggle('active');
                    contentWrapper.classList.toggle('sidebar-active');

                    // Simpan status sidebar ke LocalStorage
                    if (sidebarMenu.classList.contains('active')) {
                        localStorage.setItem('sidebarState', 'active');
                    } else {
                        localStorage.setItem('sidebarState', 'inactive');
                    }
                });

                // Jangan tutup sidebar ketika link di dalam sidebar ditekan
                const sidebarLinks = sidebarMenu.querySelectorAll('a');
                sidebarLinks.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        // Tidak ada logika tambahan di sini agar sidebar tetap aktif
                        e.stopPropagation(); // Pastikan klik tidak memengaruhi logika lainnya
                    });
                });
            });
        </script>
