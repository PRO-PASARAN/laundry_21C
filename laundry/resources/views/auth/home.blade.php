@extends('layouts.app')

@section('content')
    @php
        $pendingUsers = \App\Models\User::where('is_active', false)->get();
    @endphp
    <section class="py-12 sm:py-16 lg:py-20 xl:py-24 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Profilul meu
                </h2>
                <p class="mt-4 text-base font-normal leading-7 text-gray-600 lg:text-lg lg:mt-6 lg:leading-8">
                    Gestionează-ți informațiile personale și setările de securitate
                </p>
            </div>

            <!-- Card informativ cu detalii utilizator -->
            <div class="max-w-2xl mx-auto mt-8">
                <div class="bg-blue-50 rounded-xl p-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="text-2xl font-semibold text-blue-600">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ Auth::user()->name }}</h3>
                            <div class="mt-1 flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ Auth::user()->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    Etaj {{ Auth::user()->floor }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mesaj de succes -->
            @if(session('success'))
                <div class="max-w-2xl mx-auto mt-6">
                    <div class="rounded-xl bg-green-50 p-4 border border-green-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tab Container -->
            <div class="max-w-2xl mx-auto mt-8 bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6">
                    <div x-data="{ activeTab: 'profile' }" class="space-y-8">
                        <!-- Tab Navigation -->
                        <div class="flex justify-center">
                            <div class="inline-flex rounded-xl bg-gray-100 p-1.5">
                                <button @click="activeTab = 'profile'"
                                        :class="{ 'bg-white shadow-md text-blue-600': activeTab === 'profile', 'text-gray-500 hover:text-gray-700': activeTab !== 'profile' }"
                                        class="px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200">
                                    <div class="flex items-center space-x-2">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        <span>Informații Profil</span>
                                    </div>
                                </button>
                                <div class="flex items-center">
                                    <button @click="activeTab = 'password'"
                                            :class="{ 'bg-white shadow-md text-blue-600': activeTab === 'password', 'text-gray-500 hover:text-gray-700': activeTab !== 'password' }"
                                            class="px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200">
                                        <div class="flex items-center space-x-2">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            <span>Securitate</span>
                                        </div>
                                    </button>
                                    @if(Auth::user()->role === 'admin')
                                        <button @click="activeTab = 'pending'"
                                                :class="{ 'bg-white shadow-md text-blue-600': activeTab === 'pending', 'text-gray-500 hover:text-gray-700': activeTab !== 'pending' }"
                                                class="ml-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200">
                                            <div class="flex items-center space-x-2">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                </svg>
                                                <span>Conturi în așteptare</span>
                                            </div>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Profile Form -->
                        <div x-show="activeTab === 'profile'" x-transition>
                            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-1 gap-6">
                                    <!-- Name -->
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nume complet</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                            <input type="text" name="name" id="name"
                                                   value="{{ old('name', Auth::user()->name) }}"
                                                   class="pl-11 pr-4 py-3 block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Faculty -->
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <label for="faculty" class="block text-sm font-medium text-gray-700 mb-2">Facultate</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                            </div>
                                            <input type="text" name="faculty" id="faculty"
                                                   value="{{ old('faculty', Auth::user()->faculty) }}"
                                                   class="pl-11 pr-4 py-3 block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        @error('faculty')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Room -->
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <label for="room" class="block text-sm font-medium text-gray-700 mb-2">Număr cameră</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                </svg>
                                            </div>
                                            <input type="text" name="room" id="room"
                                                   value="{{ old('room', Auth::user()->room) }}"
                                                   class="pl-11 pr-4 py-3 block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        @error('room')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Dormitory -->
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <label for="dormitory" class="block text-sm font-medium text-gray-700 mb-2">Cămin</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                </svg>
                                            </div>
                                            <input type="text" name="dormitory" id="dormitory"
                                                   value="{{ old('dormitory', Auth::user()->dormitory) }}"
                                                   class="pl-11 pr-4 py-3 block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        @error('dormitory')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="flex justify-end pt-6">
                                    <button type="submit"
                                            class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Salvează modificările
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Password Form -->
                        <div x-show="activeTab === 'password'" x-transition>
                            <form action="{{ route('profile.password') }}" method="POST" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="space-y-4">
                                    <!-- Current Password -->
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Parola actuală</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                            </div>
                                            <input type="password" name="current_password" id="current_password"
                                                   class="pl-11 pr-4 py-3 block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        @error('current_password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- New Password -->
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Parolă nouă</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                                                </svg>
                                            </div>
                                            <input type="password" name="password" id="password"
                                                   class="pl-11 pr-4 py-3 block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                        @error('password')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="bg-gray-50 rounded-xl p-4">
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmă parola nouă</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                </svg>
                                            </div>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                   class="pl-11 pr-4 py-3 block w-full rounded-xl border-gray-200 bg-white shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-6">
                                    <button type="submit"
                                            class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        Actualizează parola
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Pending Users Section -->
                        <div x-show="activeTab === 'pending'" x-transition>
                            <div class="space-y-4">
                                <div class="bg-yellow-50 rounded-xl p-4 mb-6">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-yellow-800">
                                                Conturi care așteaptă activarea
                                            </h3>
                                            <p class="mt-2 text-sm text-yellow-700">
                                                Verifică și activează conturile noi create în platformă.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                @if($pendingUsers->isEmpty())
                                    <div class="bg-gray-50 rounded-xl p-6 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nu există conturi în așteptare</h3>
                                        <p class="mt-1 text-sm text-gray-500">Toate conturile sunt activate.</p>
                                    </div>
                                @else
                                    @foreach($pendingUsers as $user)
                                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                                            <div class="p-4">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-shrink-0">
                                                            <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                                                <span class="text-sm font-medium text-gray-600">
                                                                    {{ substr($user->name, 0, 1) }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                                            <div class="mt-1 flex items-center space-x-2">
                                                                <span class="text-xs text-gray-500">Camera {{ $user->room }}</span>
                                                                <span class="text-gray-400">•</span>
                                                                <span class="text-xs text-gray-500">Etaj {{ $user->floor }}</span>
                                                                <span class="text-gray-400">•</span>
                                                                <span class="text-xs text-gray-500">{{ $user->faculty }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('profile.activate', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            Activează
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
