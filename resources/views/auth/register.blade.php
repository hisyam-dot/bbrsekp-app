@extends('layouts.auth')

@section('content')

<div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">

    <div class="text-center mb-6">
        {{-- LOGO --}}
        <div class="flex justify-center items-center gap-3 mb-4">
            <img src="{{ asset('images/logo-kkp.png') }}" class="h-12">
            <img src="{{ asset('images/logo-kkp-2026.png') }}" class="h-12">
        </div>

        <h1 class="text-xl font-bold text-blue-900">Register</h1>
        <p class="text-sm text-gray-500">
            Balai Besar Riset Sosial Ekonomi Kelautan dan Perikanan
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text" name="name" required
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" required
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" required
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- ADMIN SECRET CODE --}}
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">
                Kode Admin (Opsional)
            </label>
            <input type="text" name="admin_code"
                class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
            class="w-full bg-blue-700 hover:bg-blue-800 text-white py-2 rounded-lg">
            Daftar
        </button>
    </form>

    {{-- LINK LOGIN & FORGOT --}}
    <div class="flex justify-between text-sm mt-4">
        <a href="{{ route('login') }}" 
        class="text-blue-700 hover:underline">
            Sudah punya akun?
        </a>

        <a href="{{ route('password.request') }}" 
        class="text-blue-700 hover:underline">
            Lupa Password?
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