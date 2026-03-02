@extends('layouts.app')

@section('content')

<section class="max-w-6xl mx-auto px-6 py-12">

    <div class="mb-6">
        <a href="{{ route('public.index') }}"
           class="inline-flex items-center text-sm text-blue-700 hover:underline">
            ← Kembali
        </a>
    </div>

    <h1 class="text-3xl font-bold text-blue-900 mb-6">
        {{ $desa->nama }}
    </h1>

    <p class="text-gray-600 mb-8">
        {{ $desa->kecamatan->nama }},
        {{ $desa->kecamatan->kabupaten->nama }},
        {{ $desa->kecamatan->kabupaten->provinsi->nama }}
    </p>

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Profil</h2>

        @if($desa->detailDesa)
            <p class="text-gray-700 leading-relaxed mb-8">
                {{ $desa->detailDesa->profil_desa }}
            </p>
        @else
            <p class="text-gray-500 mb-8">
                Profil desa belum tersedia.
            </p>
        @endif
    </div>

    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded mb-6">
        <p class="text-sm">
            Informasi lebih detail mengenai desa 
            <span class="font-semibold">{{ $desa->nama }}</span> 
            klik tombol <span class="font-semibold">'Cek Selengkapnya'</span>!
        </p>
    </div>

    <a href="{{ route('pegawai.desa.show', $desa->id) }}"
        class="inline-block bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-900 transition">
        Cek Selengkapnya
    </a>
</section>

@endsection