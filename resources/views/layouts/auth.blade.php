<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('../icon/logo.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('../css/login.css') }}">
    <title>@yield('title') - Berkah Box Balikpapan</title>
</head>

<body
    style="background: linear-gradient(to bottom, #004803, #75de64); min-height: 100vh; display: flex; align-items: center; justify-content: center;">

    <section class="container-fluid px-3 justify-content-center align-items-center">
        <div class="login-card p-4">
            <div class="text-center">
                <img src="{{ asset('icon/logo.png') }}" alt="Logo" style="width: 80px;">
                <h4 class="sub-judul mt-3">YAYASAN</h4>
                <h2 class="judul">BERKAH BOX</h2>
            </div>

            @yield('content')

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
