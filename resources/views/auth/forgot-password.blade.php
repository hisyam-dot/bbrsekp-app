@extends('layouts.auth')

@section('content')

<div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">

    <div class="flex justify-center items-center gap-3 mb-4">
        <img src="{{ asset('images/logo-kkp.png') }}" class="h-12">
        <img src="{{ asset('images/logo-kkp-2026.png') }}" class="h-12">
    </div>

    <h1 class="text-xl text-center font-bold text-blue-900 mb-4">
        Lupa Password
    </h1>
    
    <p class="text-sm text-center text-gray-500 mb-4">
        Balai Besar Riset Sosial Ekonomi Kelautan dan Perikanan
    </p>

    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" required
                class="w-full border rounded-lg px-4 py-2">
        </div>

        <button type="submit"
            class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-lg">
            Kirim Link Reset
        </button>
    </form>

    {{-- LINK REGISTER & FORGOT --}}
    <div class="flex justify-between text-sm mt-4">
        <a href="{{ route('register') }}" 
        class="text-blue-700 hover:underline">
            Belum punya akun?
        </a>

        <a href="{{ route('login') }}" 
        class="text-blue-700 hover:underline">
            Sudah ingat password?
        </a>
    </div>

    {{-- KEMBALI KE PUBLIK --}}
    <div class="text-center mt-6">
        <a href="{{ route('public.index') }}"
        class="text-sm text-blue-700 hover:underline">
            ← Kembali ke Halaman Publik
        </a>
    </div>

</div>

@endsection