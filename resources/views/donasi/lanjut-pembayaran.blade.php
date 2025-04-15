<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bekah Box Balikpapan</title>
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
    <section id="lanjut-pembayaran" style="margin-top: 110px; padding: 0 15px;">
        <div class="form-container">
            <div class="logo" style="text-align: center; margin-bottom: 20px;">
                <img src="../icon/logo.png" alt="Berkah Box Balikpapan" style="width: 80px; margin-bottom: 20px;">
                <h3 style="color: #6b6b6b; font-size: 20px; margin: 0;">Berkah Box Balikpapan</h3>
                <h2 style="color: #000000; font-size: 25px; font-weight: bold; margin-bottom: 20px;">KONFIRMASI DONASI
                </h2>
            </div>
            <div class="card" style="padding: 20px; border-radius: 5px; background-color: #f9f9f9;">
                <p style="margin-bottom: 10px;"><strong>Nama Donatur:</strong> {{ $data['nama_donatur'] }}</p>
                <p style="margin-bottom: 10px;"><strong>Nominal:</strong> Rp
                    {{ number_format($data['nominal'], 0, ',', '.') }}</p>
                <p style="margin-bottom: 20px;"><strong>Program Donasi:</strong>
                    {{ $data['program_donasi']->nama_program ?? 'Program tidak ditemukan' }}</p>
                <button id="pay-button"
                    style="background-color: #004803; border: none; color: white; width: 100%; padding: 10px; font-size: 16px; border-radius: 5px;">
                    Bayar Sekarang
                </button>
            </div>
        </div>
    </section>

    <style>
        #lanjut-pembayaran .form-container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            #lanjut-pembayaran .form-container {
                max-width: 90%;
                padding: 20px;
            }

            #lanjut-pembayaran .logo img {
                width: 70px;
            }

            #lanjut-pembayaran .logo h2 {
                font-size: 20px;
            }

            #lanjut-pembayaran .logo h3 {
                font-size: 18px;
            }

            #lanjut-pembayaran .card {
                padding: 15px;
            }

            #lanjut-pembayaran .card button {
                font-size: 14px;
                padding: 8px;
            }
        }

        @media (max-width: 576px) {
            #lanjut-pembayaran .form-container {
                max-width: 95%;
                padding: 15px;
            }

            #lanjut-pembayaran .logo img {
                width: 60px;

            }

            #lanjut-pembayaran .logo h2 {
                font-size: 18px;
            }

            #lanjut-pembayaran .logo h3 {
                font-size: 16px;
            }

            #lanjut-pembayaran .card button {
                font-size: 12px;
                padding: 6px;
            }
        }
    </style>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    console.log(result);
                    window.location.href = "{{ route('donasi.success', $data->order_id) }}";
                },
                onPending: function(result) {
                    console.log(result);
                },
                onError: function(result) {
                    console.log(result);
                }
            });
        };
    </script>

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
