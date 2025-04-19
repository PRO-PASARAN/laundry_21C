<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spălătorie Cămin 21C</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col" x-data="layout">
<!-- Navbar -->
<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Brand -->
            <div class="flex items-center">
                <a href="{{ URL('/') }}" class="flex items-center space-x-3">
                    <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                    <div>
                        <span class="text-2xl font-bold text-gray-900">Spălătorie</span>
                        <span class="block text-sm text-gray-500">Cămin 21C</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Register
                    </a>
                @else
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">
                            <div class="py-1">
                                <a href="{{ route('home') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Profile
                                </a>
                                <a href="{{ route('appointments.index') }}" class="group flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <svg class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Programări
                                </a>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="group flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                    <svg class="mr-3 h-5 w-5 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @guest
                <a href="{{ route('login') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50">
                    Register
                </a>
            @else
                <a href="{{ route('home') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50">
                    Profile
                </a>
                <a href="{{ route('appointments.index') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-900 hover:bg-gray-50">
                    Programări
                </a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                   class="block px-4 py-2 text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50">
                    Logout
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="flex-grow">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <span class="text-sm text-gray-500">Spălătorie Cămin 21C</span>
            </div>
            <div class="text-sm text-gray-500">
                Powered by <span class="font-medium">Pasaran Razvan</span>
            </div>
        </div>
    </div>
</footer>

<!-- Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('layout', () => ({
            mobileMenuOpen: false
        }))
    })
</script>
</body>
</html>
