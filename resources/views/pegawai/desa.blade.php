@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-6 py-1">

    <div class="mb-3">
        <a href="{{ route('pegawai.index') }}"
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

    <div class="mt-3">
        <h2 class="text-xl font-semibold mb-1">Lokasi</h2>

        @if($detail->lokasi)
            <a href="{{ $detail->lokasi }}"
                target="_blank"
                class="text-blue-600 hover:underline">
                Lihat Lokasi di Google Maps →
            </a>
        @else
            <p class="text-gray-500">Lokasi belum tersedia.</p>
        @endif
    </div>

    <div class="mt-3">
        <h2 class="text-xl font-semibold mb-1">Foto Lokasi</h2>

        @if($detail->foto)

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($detail->foto as $foto)
                <div class ="group relative cursor-pointer"
                onclick="openModal('{{ asset('storage/'.$foto) }}')">
            
            <img src="{{ asset('storage/'.$foto) }}"
                class="w-full h-40 object-cover rounded-lg shadow-md transform transition duration-300 group-hover:scale-105 group-hover:shadow-xl">
            </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-70 hidden flex items-center justify-center z-50">
            <div class="relative max-w-3xl w-full px-4">
                <button onclick="closeModal()" class="absolute top-2 right-4 text white text-3xl font-bold">&times;</button>

                <img id="modalImage" class="w-full rounded-lg shadow-lg">
            </div>
        </div>

        <script>
            function openModal(src) {
                document.getElementById('modalImage').src = src;
                document.getElementById
                ('imageModal').classList.remove('hidden');
            }

            function closeModal() {
                document.getElementById('imageModal').classList.add('hidden');
            }
        </script>

        @else
            <p class="text-gray-500">Foto belum tersedia.</p>
        @endif
    </div>

    <div class="mt-3">
        <h2 class="text-xl font-semibold mb-1">Bahan Paparan</h2>

        @if($detail->bahan_paparan)

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">

                @foreach($detail->bahan_paparan as $bahan_paparan)
                    <div class="bg-white rounded-lg shadow-md p-1 text-center text-sm hover:shadow-xl transition duration-300">

                        <div class="text-4xl mb-3">📄</div>

                        <p class="text-sm font-medium text-gray-700 truncate mb-4">
                            {{ basename($bahan_paparan) }}
                        </p>

                        <a href="{{ asset('storage/'.$bahan_paparan) }}"
                        target="_blank"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Lihat Bahan Paparan
                        </a>
                    </div>
                @endforeach

            </div>

        @else
        <p class="text-gray-500">Dokumen belum tersedia.</p>
        @endif
    </div>

    <div class="mt-3">
        <h2 class="text-xl font-semibold mb-1">Laporan</h2>

        @if($detail->laporan)

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">

                @foreach($detail->laporan as $laporan)
                    <div class="bg-white rounded-lg shadow-md p-1 text-center text-sm hover:shadow-xl transition duration-300">

                        <div class="text-4xl mb-3">📄</div>

                        <p class="text-sm font-medium text-gray-700 truncate mb-4">
                            {{ basename($laporan) }}
                        </p>

                        <a href="{{ asset('storage/'.$laporan) }}"
                        target="_blank"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Lihat Laporan
                        </a>
                    </div>
                @endforeach

            </div>

        @else
        <p class="text-gray-500">Dokumen belum tersedia.</p>
        @endif
    </div>

    <div class="mt-3">
        <h2 class="text-xl font-semibold mb-1">Dokumen Lainnya</h2>

        @if($detail->dokumen)

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">

                @foreach($detail->dokumen as $dokumen)
                    <div class="bg-white rounded-lg shadow-md p-1 text-center text-sm hover:shadow-xl transition duration-300">

                        <div class="text-4xl mb-3">📄</div>

                        <p class="text-sm font-medium text-gray-700 truncate mb-4">
                            {{ basename($dokumen) }}
                        </p>

                        <a href="{{ asset('storage/'.$dokumen) }}"
                        target="_blank"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Lihat Dokumen
                        </a>
                    </div>
                @endforeach

            </div>

        @else
        <p class="text-gray-500">Dokumen belum tersedia.</p>
        @endif
    </div>
</section>

@endsection