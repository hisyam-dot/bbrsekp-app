@extends('layouts.app')

@section('content')

<section class="max-w-6xl mx-auto px-6 py-1">

    <div class="mb-3">
        <a href="{{ route('public.index') }}"
           class="inline-flex items-center text-sm text-blue-700 hover:underline">
            ← Kembali
        </a>
    </div>

    <h1 class="text-3xl font-bold text-blue-900 mb-1">
        {{
            $detail->nama
            ?? $detail->kecamatan->nama
            ?? $detail-> kabupaten->nama
            ?? $detail->provinsi->nama
        }} - {{ $detail->judul }}
    </h1>

    @php
        $lokasi = collect([
        $detail->kecamatan->nama ?? null,
        $detail->kabupaten->nama ?? null,
        $detail->provinsi->nama ?? null,
        ])->filter()->implode(', ');
    @endphp
    
    <p class="text-gray-600 mb-3">
        {{ $lokasi ?: '-' }}
    </p>

    <div class="mt-3">
        <h2 class="text-xl font-semibold mb-1">Profil / Deskripsi</h2>

        @if($detail->profil)
            <p class="text-gray-700 leading-relaxed mb-3">
                {{ $detail->profil }}
            </p>
        @else
            <p class="text-gray-500 mb-3">
                Profil / deskripsi belum tersedia.
            </p>
        @endif
    </div>

    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded mb-3">
        <p class="text-sm">
            Informasi lebih detail mengenai
            <span class="font-semibold">
                {{
                    $detail->desa->nama
                    ?? $detail->kecamatan->nama
                    ?? $detail->kabupaten->nama
                    ?? $detail->provinsi->nama
                }}
            </span>
            klik tombol <span class="font-semibold">'Cek Selengkapnya'</span>!
        </p>
    </div>

    <a href="{{ route('pegawai.desa.show', $detail->id) }}"
        class="inline-block bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-900 transition">
        Cek Selengkapnya
    </a>
</section>

@endsection