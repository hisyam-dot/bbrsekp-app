<nav class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">

        {{-- LEFT: LOGO --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('logo1.png') }}" alt="Logo 1" class="h-8">
            <img src="{{ asset('logo2.png') }}" alt="Logo 2" class="h-8">
        </div>

        {{-- CENTER: TITLE --}}
        <div class="text-lg font-semibold tracking-wide">
            BBRSEKP
        </div>

        {{-- RIGHT: ROLE & AUTH --}}
        <div class="flex items-center space-x-4">

            @auth
                <span class="text-sm text-gray-600">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Login
                </a>
            @endauth

        </div>
    </div>
</nav>