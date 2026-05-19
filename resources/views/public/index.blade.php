@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center text-center mt-16 mb-10">

    {{-- LOGO --}}
    <div class="flex items-center gap-4 mb-6 group">
        <img src="{{ asset('images/logo-kkp.png') }}"
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

    {{-- SEARCH + POPULER --}}
    <form method="GET" action="{{ route('public.index') }}" class="mb-8">
        <div class="flex gap-4 items-start">

        {{-- SEARCH 70% --}}
            <div class="w-[70%]">
                <input 
                    type="text" 
                    name="q"
                    value="{{ $search }}"
                    placeholder="Cari provinsi / kabupaten / kecamatan / desa / judul"
                    class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-sm"
                >
            </div>

            {{-- POPULER 30% --}}
            <div class="w-[30%] relative">
                <button type="button" onclick="toggleDropdown()" class="w-full bg-gray-100 border rounded-lg px-4 py-3 text-left">
                    Pencarian Populer
                </button>

                {{-- DROPDOWN --}}
                <div id="dropdownPopuler" class="hidden absolute z-50 mt-2 w-full bg-white border rounded-lg shadow-lg overflow-hidden">

                    @foreach($populer as $item)
                        <a href="{{ route('public.index', ['q' => $item->keyword]) }}"
                            class="flex items-center justify-between px-4 py-3 hover:bg-blue-50 transition group">

                            {{-- LEFT (ICON + TEXT) --}}
                            <div class-"flex items-center gap-2">

                                {{-- ICON --}}
                                <svg xmlns="http://www.w3.org/2000/svg" 
                                    class="w-10 h-7 text-gray-400 group-hover:text-blue-500" fill="none" viewBo="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 0 000 16z" />
                                </svg>

                                {{-- TEXT --}}
                                <span class="text-gray-700 group-hover:text-blur-700 font-medium">
                                    {{ ucwords($item->keyword) }}
                                </span>
                            </div>

                            {{-- RIGHT (COUNT) --}}
                            <span class="text-ts bg-gray-100 text-gray-600 px-2 py-1 rounded-full">
                                {{ $item->total }}x
                            </span>
                        </a>
                    @endforeach

                </div>
            </div>
            
        </div>
    </form>

    {{-- INFO HASIL PENCARIAN --}}
    @if($search)
        <div class="mb-6">
            <span class="inline-block bg-blue-50 px-4 py-2 rounded-lg text-sm shadow-sm text-blue-700">
                {{ $details->total() }}
            </span> data ditemukan untuk pencarian "<span class="italic">{{ ucfirst($search) }}</span>"
        </div>
    @endif

    {{-- LIST LOKASI (FULL 100%) --}}
    <div class="space-y-5">

        @forelse($details as $detail)
            <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition">

                <div class="flex justify-between items-center">

                    <div>
                        <h3 class="text-xl font-semibold text-blue-900">
                            {{
                                $detail->nama
                                ?? $detail->kecamatan->nama
                                ?? $detail-> kabupaten->nama
                                ?? $detail->provinsi->nama
                            }} - {{ $detail->judul }}
                        </h3>

                        @php
                            $lokasi = collect([
                                $detail->kecamatan->nama ?? null,
                                $detail->kabupaten->nama ?? null,
                                $detail->provinsi->nama ?? null,
                            ])->filter()->implode(', ');
                        @endphp

                        <p class="text-gray-600 text-sm mt-1">
                            {{ $lokasi ?: '-' }}
                        </p>
                    </div>

                    <a href="{{ route('public.desa.show', $detail->id) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition">
                        Lihat Detail
                    </a>

                </div>

            </div>
        @empty
            <p class="text-gray-500">
                Data / informasi belum tersedia.
            </p>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-10 flex justify-center">
        {{ $details->links() }}
    </div>
</section>

<script>
    function toggleDropdown() {
        const el = document.getElementById('dropdownPopuler');
        el.classList.toggle('hidden');
    }

    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('dropdownPopuler');
        const button = e.target.closest('button');

        if (!button && dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
@endsection