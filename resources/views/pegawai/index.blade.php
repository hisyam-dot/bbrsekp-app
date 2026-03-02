@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center text-center mt-16 mb-10">

    {{-- LOGO --}}
    <div class="flex items-center gap-4 mb-6 group">
        <img src="{{ asset('images/logo-kkp.png') }}"
            class="h-20 transition duration-300 group-hover:scale-105">
        <img src="{{ asset('images/logo-kkp-2026.png') }}"
            class="h-20 transition duration-300 group-hover:scale-105">
    </div>

    {{-- TITLE --}}
    <h1 class="text-2xl md:text-3xl font-bold text-blue-900">
        BALAI BESAR RISET SOSIAL EKONOMI KELAUTAN DAN PERIKANAN
    </h1>

    <p class="text-gray-600 mt-2">
        Kementerian Kelautan dan Perikanan Republik Indonesia
    </p>

</div>

{{-- SEARCH + LIST --}}
<section class="max-w-7xl mx-auto px-6 py-12">
    {{-- SEARCH --}}
    <form method="GET" action="{{ route('pegawai.index') }}" class="mb-8">
        <input 
            type="text" 
            name="q"
            value="{{ $search }}"
            placeholder="Cari provinsi / kabupaten / kecamatan / desa"
            class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring focus:ring-blue-200"
        >
    </form>

    {{-- LIST DESA --}}
    <div class="space-y-5">

        @forelse($desas as $desa)
            <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition">

                <div class="flex justify-between items-center">

                    <div>
                        <h3 class="text-xl font-semibold text-blue-900">
                            {{ $desa->nama }}
                        </h3>

                        <p class="text-gray-600 text-sm mt-1">
                            {{ $desa->kecamatan->nama }},
                            {{ $desa->kecamatan->kabupaten->nama }},
                            {{ $desa->kecamatan->kabupaten->provinsi->nama }}
                        </p>
                    </div>

                    <a href="{{ route('pegawai.desa.show', $desa->id) }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition">
                        Lihat Profil
                    </a>

                </div>

            </div>
        @empty
            <p class="text-gray-500">
                Data desa belum tersedia.
            </p>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-10 flex justify-center">
        {{ $desas->links() }}
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