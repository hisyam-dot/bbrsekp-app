@extends('layouts.app')

@section('content')
<section class="max-w-6xl mx-auto px-6 py-12">

    <div class="mb-6">
        <a href="{{ route('pegawai.index') }}"
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

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Lokasi</h2>

        @if($desa->detailDesa && $desa->detailDesa->lokasi)
            <a href="{{ $desa->detailDesa->lokasi }}"
                target="_blank"
                class="text-blue-600 hover:underline">
                Lihat Lokasi di Google Maps →
            </a>
        @else
            <p class="text-gray-500">Lokasi belum tersedia.</p>
        @endif
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Foto Desa</h2>

        @if($desa->detailDesa?->foto)

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($desa->detailDesa->foto as $foto)
                <div class ="group relative cursor-pointer"
                onclick="openModal('{{ asset('storage/'.$foto) }}')">
            
            <img src="{{ asset('storage/'.$foto) }}"
                class="w-full h-56 object-cover rounded-lg shadow-md transform transition duration-300 group-hover:scale-105 group-hover:shadow-xl">
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

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Bahan Paparan</h2>

        @if($desa->detailDesa?->bahan_paparan)

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                @foreach($desa->detailDesa->bahan_paparan as $bahan_paparan)
                    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition duration-300">

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

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Laporan</h2>

        @if($desa->detailDesa?->laporan)

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                @foreach($desa->detailDesa->laporan as $laporan)
                    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition duration-300">

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

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Dokumen Lainnya</h2>

        @if($desa->detailDesa?->dokumen)

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

                @foreach($desa->detailDesa->dokumen as $dokumen)
                    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition duration-300">

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