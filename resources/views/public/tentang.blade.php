@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<section class="bg-gradient-to-b from-blue-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid md:grid-cols-2 gap-10 items-center">

            {{-- LEFT: SLIDER --}}
            <div class="relative overflow-hidden rounded-2xl shadow-xl">

                <div id="hero-slider" class="relative w-full h-[500px]">

                    <img src="{{ asset('images/slider/struktur-organisasi.jpg') }}"
                         class="slide absolute inset-0 w-full h-full object-cover opacity-100 transition-opacity duration-700">

                    <img src="{{ asset('images/slider/materi-pelatihan.jpg') }}"
                        class="slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-700">

                    <img src="{{ asset('images/slider/hasil-pelatihan.jpg') }}"
                        class="slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-700">

                    <img src="{{ asset('images/slider/perolehan.jpg') }}"
                        class="slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-700">

                    <img src="{{ asset('images/slider/ois.jpg') }}"
                        class="slide absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-700">
                </div>

                {{-- NAVIGATION --}}
                <button onclick="prevSlide()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-3 rounded-full shadow">
                    ◀
                </button>

                <button onclick="nextSlide()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-3 rounded-full shadow">
                    ▶
                </button>
            </div>

            {{-- RIGHT: SEJARAH --}}
            <div>
                <h2 class="text-3xl font-bold text-blue-900 mb-6">
                    Sejarah Singkat
                </h2>

                <div class="space-y-4 text-gray-700 leading-relaxed text-justify">

                    <p>
                        Balai Besar Riset Sosial Ekonomi Kelautan dan Perikanan (BBRSEKP)
                        dibentuk pertama kali melalui Peraturan Menteri Kelautan dan
                        Perikanan Nomor Per.09/Men/2005 tentang Organisasi dan Tata Kerja
                        Balai Besar Riset Sosial Ekonomi Kelautan dan Perikanan.
                    </p>

                    <p>
                        BBRSEKP bertugas melaksanakan riset strategis sosial ekonomi
                        kelautan dan perikanan meliputi sosial ekonomi pengelolaan sumber
                        daya, pengembangan usaha, dan perdagangan internasional.
                    </p>

                    <p>
                        Dalam perjalanannya, lembaga ini mengalami perubahan nomenklatur
                        organisasi pada tahun 2011, 2015, dan 2017 hingga kembali menjadi
                        Balai Besar Riset Sosial Ekonomi Kelautan dan Perikanan.
                    </p>

                    <p>
                        Saat ini, BBRSEKP berada di bawah Badan Penyuluhan dan
                        Pengembangan Sumber Daya Manusia Kelautan dan Perikanan
                        (BPPSDMKP) dan memiliki peran strategis dalam pembangunan
                        kelautan dan perikanan.
                    </p>

                </div>
            </div>

        </div>
    </div>
</section>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.opacity = i === index ? '1' : '0';
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    setInterval(nextSlide, 5000);
</script>

@endsection