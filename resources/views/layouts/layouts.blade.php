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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

    {{-- navbar --}}
    @include('layouts.navbar')
    {{-- content --}}
    @yield('content')

    {{-- footer --}}
    <section id="footer" style="background-color: #E3E3E3;">
        <div class="container py-4" style="padding: 0 15px;">
            <footer>
                <div class="row">
                    @foreach ($kontak as $kontak)
                        <!-- Col Map -->
                        <div class="col-lg-6 col-md-12" style="margin-bottom: 10px;">
                            <div class="map-container" style="width: 100%; height: 300px;">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.9684602356674!2d116.8590791737711!3d-1.1826125988060812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df149022cf663d3%3A0x57aeba6af5abde40!2sMasjid%20Berkah%20Box%20-%20KM11%20-%20Balikpapan!5e0!3m2!1sid!2sid!4v1749885754146!5m2!1sid!2sid"
                                    width="100%" height="100%" style="border: 0;" allowfullscreen=""
                                    loading="lazy"></iframe>
                            </div>
                        </div>

                        <!-- Col Kontak -->
                        <div class="col-lg-6 col-md-12" style="margin-bottom: 10px;">
                            <h5 class="fw-bold mt-4" style="font-size: 20px; margin-bottom: 10px;">HUBUNGI KAMI</h5>
                            <p style="font-size: 16px; margin-bottom: 10px;">Untuk Informasi Mengenai Berkah Box
                                Berbagi Silahkan Hubungi:</p>
                            <ul class="nav flex-column" style="list-style: none; padding: 0; margin: 0;">
                                <li style="margin-bottom: 5px;">
                                    <a href="#" class="nav-link text-dark"
                                        style="display: flex; align-items: center; font-size: 14px;">
                                        <i class="fas fa-map-marker-alt"
                                            style="margin-right: 10px; font-size: 16px;"></i>
                                        {{ $kontak->alamat }}
                                    </a>
                                </li>
                                <li style="margin-bottom: 5px;">
                                    <a href="#" class="nav-link text-dark"
                                        style="display: flex; align-items: center; font-size: 14px;">
                                        <i class="fas fa-phone" style="margin-right: 10px; font-size: 16px;"></i>
                                        {{ $kontak->no_telp }}
                                    </a>
                                </li>
                                <li style="margin-bottom: 5px;">
                                    <a href="https://www.facebook.com/aisyah.berbagi.77?mibextid=ZbWKwL"
                                        class="nav-link text-dark"
                                        style="display: flex; align-items: center; font-size: 14px;">
                                        <i class="fab fa-facebook" style="margin-right: 10px; font-size: 16px;"></i>
                                        {{ $kontak->facebook }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </footer>
        </div>
    </section>

    <section class="border-top" style="color: white; background-color: #d57e04;">
        <div class="container py-3" style="padding: 0 15px;">
            <div class="d-flex justify-content-between" style="flex-wrap: wrap; align-items: center;">
                <div class="fw-bold" style="font-size: 16px;">BERKAH BOX BALIKPAPAN</div>
            </div>
        </div>
    </section>


    {{-- end footer --}}
    <!-- Tombol WhatsApp Melayang -->
    <a href="https://wa.me/628112168676" class="whatsapp-button" target="_blank" title="Chat via WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>


    <script>
        let currentIndex = 0;

        function moveSlide(direction) {
            const sliderContainer = document.querySelector('.slider-container');
            const totalSlides = sliderContainer.children.length;
            const slideWidth = sliderContainer.children[0].offsetWidth;

            currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
            sliderContainer.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
        }

        window.addEventListener('resize', () => {
            document.querySelector('.slider-container').style.transform =
                `translateX(-${currentIndex * document.querySelector('.slider-item').offsetWidth}px)`;
        });
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
    <script>

    document.querySelectorAll('.fasilitas-card').forEach(card => {
    card.addEventListener('click', function() {
        this.classList.toggle('clicked'); // Toggle the clicked class on card click
    });
});
</script>

    @yield('scripts')
</body>

</html>
