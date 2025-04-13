<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spalatorie Camin 21C - Laravel 11 Custom User Registration & Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<!-- Navbar -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Brand -->
            <div class="flex items-center">
                <a href="{{ URL('/') }}" class="text-2xl font-bold text-gray-800">
                    Spalatorie Camin 21C
                </a>
            </div>
            <!-- Desktop Menu -->
            <div class="hidden sm:flex sm:items-center">
                @guest
                    <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-500">Login</a>
                    <a href="{{ route('register') }}" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-500">Register</a>
                @else
                    <div class="relative inline-block text-left">
                        <button id="user-menu-button" type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-500 focus:outline-none" aria-expanded="true" aria-haspopup="true">
                            {{ Auth::user()->name }}
                            <svg class="ml-1 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div id="user-menu-dropdown" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                            <div class="py-1">
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                <button id="mobile-menu-button" type="button" class="p-2 rounded-md text-gray-600 hover:text-blue-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="sm:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @guest
                <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-500 hover:bg-gray-50">Login</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-500 hover:bg-gray-50">Register</a>
            @else
                <a href="{{ route('logout') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-500 hover:bg-gray-50"
                   onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">
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
<main class="container mx-auto px-4 py-6">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white shadow-inner mt-8">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <p class="text-center text-gray-600 text-sm">Powered by Pasaran Razvan</p>
    </div>
</footer>

<!-- Scripts -->
<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Toggle user dropdown menu on desktop
    const userMenuButton = document.getElementById('user-menu-button');
    if (userMenuButton) {
        userMenuButton.addEventListener('click', function(event) {
            event.stopPropagation();
            document.getElementById('user-menu-dropdown').classList.toggle('hidden');
        });
    }

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('user-menu-dropdown');
        if (dropdown && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
        }
    });
</script>
</body>
</html>
