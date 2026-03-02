<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BBRSEKP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('iamges/logo-kkp.png') }}" rel="icon" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-800 min-h-screen flex flex-col">

{{-- NAVBAR --}}
<header class="fixed top-0 left-0 w-full bg-white border-b shadow-sm z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-kkp.png') }}" class="h-12" alt="Logo KKP">
            <img src="{{ asset('images/logo-kkp-2026.png') }}" class="h-12" alt="Logo KKP 2026">
            <div>
                <p class="text-sm font-bold text-blue-900">
                    BALAI BESAR RISET SOSIAL EKONOMI KELAUTAN DAN PERIKANAN
                </p>
                <p class="text-xs text-gray-600">
                    Kementerian Kelautan dan Perikanan RI
                </p>
            </div>
        </div>

        <nav class="flex items-center gap-4 text-sm">

            @guest
                {{-- PUBLIC --}}
                <a href="{{ route('public.index') }}"
                class="{{ request()->routeIs('public.index') ? 'text-blue-600 font-bold' : 'text-blue-800 font-medium hover:underline' }}">
                    Beranda
                </a>

                <a href="{{ route('public.tentang') }}"
                class="{{ request()->routeIs('public.tentang') ? 'text-blue-600 font-bold' : 'text-blue-800 font-medium hover:underline' }}">
                    Tentang
                </a>

                <span class="text-gray-500">Publik</span>

                <a href="{{ route('login') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-900 transition">
                    Login
                </a>
            @endguest


            @auth

                    {{-- PEGAWAI --}}
                    <a href="{{ route('pegawai.index') }}"
                    class="{{ request()->routeIs('pegawai.index') ? 'text-blue-600 font-bold' : 'text-blue-800 font-medium hover:underline' }}">
                        Beranda
                    </a>

                    <a href="{{ route('pegawai.tentang') }}"
                    class="{{ request()->routeIs('pegawai.tentang') ? 'text-blue-600 font-bold' : 'text-blue-800 font-medium hover:underline' }}">
                        Tentang
                    </a>


                <span class="text-blue-800 font-medium">
                    {{ auth()->user()->name }}
                </span>


                @if(auth()->user()->role == 'admin')
                    <a href="{{ url('/admin') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">
                        Admin Panel
                    </a>
                @endif


                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-900 transition">
                        Logout
                    </button>
                </form>

            @endauth

        </nav>
    </div>
</header>

{{-- CONTENT --}}
<main class="flex-1 pt-24">
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="bg-blue-900 text-white mt-12">
    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="grid md:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logo-kkp.png') }}" class="h-12" alt="Logo KKP">
                <img src="{{ asset('images/logo-kkp-2026.png') }}" class="h-12" alt="Logo KKP 2026">
                <span class="font-bold text-lg">
                    BALAI BESAR RISET SOSIAL EKONOMI KELAUTAN DAN PERIKANAN
                </span>
            </div>

            {{-- MEDIA SOSIAL --}}
            <div>
                <h3 class="font-semibold mb-3">Media Sosial</h3>
                <div class="flex space-x-4 text-xl">
                    <a href="https://www.youtube.com/@bppsdm_bbrsekp" target="blank"><i class="fab fa-youtube hover:text-red-400"></i></a>
                    <a href="https://www.instagram.com/bppsdm_bbrsekp?igsh=bWJqbXc5ZnBsZmg1" target="blank"><i class="fab fa-instagram hover:text-pink-400"></i></a>
                    <a href="https://www.facebook.com/bppsdmkp/?locale=id_ID" target="blank"><i class="fab fa-facebook hover:text-blue-400"></i></a>
                    <a href="https://x.com/bppsdm_kp" target="blank"><i class="fab fa-x-twitter hover:text-gray-400"></i></a>
                    <a href="https://api.whatsapp.com/send?phone=+628118751141&text=Halo%20Admin%20KKP" target="blank"><i class="fab fa-whatsapp hover:text-green-400"></i></a>
                    <a href="https://www.tiktok.com/@bppsdm_kp" target="blank"><i class="fab fa-tiktok hover:text-black-400"></i></a>
                </div>
            </div>

            {{-- KONTAK --}}
            <div>
                <h3 class="font-semibold mb-3">Kontak</h3>
                <p>Jl. Medan Merdeka Timur No.16</p>
                <p>Telp. (021) 3519070 EXT. 7433 – Fax. (021) 3864293</p>
                <p>Email: humas.kkp@kkp.go.id</p>
                <p>Call Center: 141</p>
            </div>

        </div>

        <div class="border-t border-blue-700 mt-6 pt-4 text-center text-sm">
            © Copyright {{ date('Y') }}, Kementerian Kelautan dan Perikanan Republik Indonesia
        </div>
    </div>
</footer>
</body>
</html>
