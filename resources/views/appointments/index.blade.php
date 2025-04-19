@extends('layouts.app')

@section('content')
    <section class="py-12 sm:py-16 lg:py-20 xl:py-24 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Programări Spălătorie
                </h2>
                <p class="mt-4 text-base font-normal leading-7 text-gray-600 lg:text-lg lg:mt-6 lg:leading-8">
                    Săptămâna {{ now()->startOfWeek()->format('d M') }} - {{ now()->endOfWeek()->format('d M Y') }}
                </p>
            </div>

            <!-- Selector de etaj pentru admin -->
            @if(Auth::user()->role === 'admin')
                <div class="max-w-xs mx-auto mt-8">
                    <form action="{{ route('appointments.index') }}" method="GET" class="flex items-center space-x-4">
                        <select name="floor"
                                onchange="this.form.submit()"
                                class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                            @for($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ request('floor') == $i ? 'selected' : '' }}>
                                    Etajul {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </form>
                </div>

                <!-- Indicator etaj curent pentru admin -->
                <div class="max-w-2xl mx-auto mt-6">
                    <div class="bg-blue-50 rounded-xl p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-blue-800">
                                    @if(request('floor') !== null && request('floor') !== '')
                                        Vizualizezi programările pentru Etajul {{ request('floor') }}
                                    @else
                                        Vizualizezi programările pentru toate etajele
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Indicator etaj pentru student -->
                <div class="max-w-2xl mx-auto mt-6">
                    <div class="bg-blue-50 rounded-xl p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-blue-800">
                                    Vizualizezi programările pentru Etajul {{ Auth::user()->floor }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex justify-center mt-8">
                <a href="{{ route('appointments.create') }}"
                   class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Programare nouă
                </a>
            </div>

            @if(session('success'))
                <div class="max-w-2xl mx-auto mt-6">
                    <div class="rounded-xl bg-green-50 p-4">
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

            <div class="max-w-7xl mx-auto mt-8 bg-white shadow-xl rounded-2xl sm:mt-12 overflow-hidden">
                <div class="relative overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr>
                            <th class="sticky left-0 z-10 bg-gray-100 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-r">
                                Interval
                            </th>
                            @foreach(['Luni', 'Marți', 'Miercuri', 'Joi', 'Vineri', 'Sâmbătă', 'Duminică'] as $day)
                                <th class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    {{ $day }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach(['08-12', '12-16', '16-20', '20-24', '00-04'] as $timeSlot)
                            <tr>
                                <td class="sticky left-0 z-10 bg-gray-50 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r">
                                    {{ $timeSlot }}
                                </td>
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $appointment = $appointments->first(function($app) use ($timeSlot, $day) {
                                                return $app->slot === $timeSlot &&
                                                       date('l', strtotime($app->date)) === $day;
                                            });
                                        @endphp

                                        @if($appointment)
                                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-3">
                                                        <div class="flex-shrink-0">
                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100">
                        <span class="text-sm font-medium leading-none text-blue-800">
                            {{ substr($appointment->user->name, 0, 1) }}
                        </span>
                    </span>
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <p class="text-sm font-medium text-gray-900">
                                                                {{ $appointment->user->name }}
                                                            </p>
                                                            <p class="text-sm text-gray-500">
                                                                Etaj {{ $appointment->floor }}
                                                            </p>
                                                            <p class="text-xs text-gray-400 mt-1">
                                                                {{ date('d/m/Y', strtotime($appointment->date)) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @if(Auth::user()->role === 'admin')
                                                        <div class="ml-4">
                                                            <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST"
                                                                  onsubmit="return confirm('Ești sigur că vrei să ștergi această programare?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="inline-flex items-center p-1.5 border border-transparent rounded-lg text-sm text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="h-full w-full rounded-xl border border-dashed border-gray-200 p-4">
                                                <p class="text-sm text-gray-400 text-center">Disponibil</p>
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Legendă -->
            <div class="max-w-2xl mx-auto mt-8 bg-white shadow-xl rounded-2xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                <svg class="h-6 w-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Programare existentă</p>
                            <p class="text-sm text-gray-500">Slot ocupat</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-10 w-10 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center">
                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Slot liber</p>
                            <p class="text-sm text-gray-500">Disponibil pentru programare</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
