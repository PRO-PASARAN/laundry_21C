@extends('layouts.app')

@section('content')
    <section class="py-12 sm:py-16 lg:py-20 xl:py-24 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Programare nouă
                </h2>
                <p class="mt-4 text-base font-normal leading-7 text-gray-600 lg:text-lg lg:mt-6 lg:leading-8">
                    Completează detaliile pentru noua programare la spălătorie
                </p>
            </div>

            <div class="max-w-2xl mx-auto mt-8 bg-white shadow-xl rounded-2xl sm:mt-12">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('appointments.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Data programării -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <label for="date" class="block text-sm font-medium text-gray-500">
                                Data programării
                            </label>
                            <div class="mt-2">
                                <input
                                    type="date"
                                    name="date"
                                    id="date"
                                    value="{{ old('date', date('Y-m-d')) }}"
                                    class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                >
                            </div>
                            @error('date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Interval orar -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <label for="slot" class="block text-sm font-medium text-gray-500">
                                Interval orar
                            </label>
                            <div class="mt-2">
                                <select
                                    name="slot"
                                    id="slot"
                                    class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required
                                >
                                    @foreach($slots as $slot)
                                        <option value="{{ $slot }}">{{ $slot }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('slot')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Etaj (pentru admin) -->
                        @if(Auth::user()->role === 'admin')
                            <div class="bg-gray-50 rounded-xl p-6">
                                <label for="floor" class="block text-sm font-medium text-gray-500">
                                    Etaj
                                </label>
                                <div class="mt-2">
                                    <select
                                        name="floor"
                                        id="floor"
                                        class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required
                                    >
                                        @for($i = 0; $i < 6; $i++)
                                            <option value="{{ $i }}">Etajul {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="floor" value="{{ $user_floor }}">
                        @endif

                        <!-- Informații despre programare -->
                        <div class="bg-blue-50 rounded-xl p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800">
                                        Informații importante
                                    </h3>
                                    <div class="mt-2 text-sm text-blue-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            <li>Programările se pot face doar pentru următoarele 7 zile</li>
                                            <li>Un interval orar durează 4 ore</li>
                                            <li>Poți face o singură programare pe zi</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Butoane de acțiune -->
                        <div class="flex items-center justify-end space-x-4 pt-6">
                            <a
                                href="{{ route('appointments.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                Anulează
                            </a>
                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Salvează programarea
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card informativ -->
            <div class="max-w-2xl mx-auto mt-8 bg-white shadow-xl rounded-2xl p-6">
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                    </div>
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Etajul tău: {{ Auth::user()->floor }}</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if(Auth::user()->role === 'admin')
                                Poți face programări pentru toate etajele
                            @else
                                Poți face programări doar pentru etajul tău
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
