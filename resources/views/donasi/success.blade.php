<!DOCTYPE html>
<html lang="en">

<head>
    <title>Berkah Box Balikpapan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="public/icon/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/lightbox.css">

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    {{-- navbar --}}
    @include('layouts.navbar')
    {{-- content --}}
    @yield('content')
    <section id="berhasil" style="margin-top: 110px; padding: 0 15px;">
        <div
            style="max-width: 600px; margin: 50px auto; padding: 30px; background-color: white; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8); border-radius: 8px; text-align: center;">

            <!-- Logo -->
            <div class="logo py-2">
                <img src="../../icon/logo.png" alt="Berkah Box Balikpapan" style="width: 80px; margin-bottom: 20px;">
                <h3 style="color: #6b6b6b; font-size: 20px; margin: 0;">BERKAH BOX</h3>
                <h2 style="color: #000000; font-size: 25px; font-weight: bold; margin-bottom: 20px;">Terima Kasih!</h2>
            </div>

            <!-- Pesan -->
            <div class="content">
                <p style="font-size: 18px; color: #333; line-height: 1.6; margin-bottom: 20px;">
                    Terima kasih telah berdonasi untuk program kami. Semoga donasi Anda membawa manfaat bagi banyak
                    orang.
                </p>
                <a href="{{ route('home') }}" class="btn btn-success mt-3"
                    style="display: inline-block; padding: 10px 20px; font-size: 16px; border-radius: 5px; background-color: #004803; color: white; text-decoration: none; border: none;">
                    Kembali ke Halaman Utama
                </a>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}

    <script src="../js/lightbox-plus-jquery.js"></script>
    <script src="('../js/lightbox.min.js')"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
