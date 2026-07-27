<nav class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" class="w-10 h-10" alt="">
                <span class="font-bold text-red-600 text-xl">
                    Bakso Pakde Heru
                </span>
            </a>

            <div class="flex items-center gap-6">

                <a href="{{ route('home') }}" class="hover:text-red-600">
                    Home
                </a>

                @auth

                    <span class="font-semibold">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            Logout
                        </button>

                    </form>

                @else

                    <a href="{{ route('login') }}" class="hover:text-red-600">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                        Register
                    </a>

                @endauth

            </div>

        </div>
    </div>
</nav>
