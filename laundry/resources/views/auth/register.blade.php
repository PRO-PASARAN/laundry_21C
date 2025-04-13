@extends('layouts.app')

@section('content')
    <section class="py-12 sm:py-16 lg:py-20 xl:py-24 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Create your account
                </h2>
                <p class="mt-4 text-base font-normal leading-7 text-gray-600 lg:text-lg lg:mt-6 lg:leading-8">
                    Join us by filling out the form below.
                </p>
            </div>

            <div class="max-w-lg mx-auto mt-8 bg-white shadow-xl rounded-2xl sm:mt-12">
                <div class="p-6 sm:px-8">
                    <form action="{{ route('store') }}" method="post" class="space-y-5">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="sr-only">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Your Name"
                                value="{{ old('name') }}"
                                class="block w-full px-6 py-4 text-base text-center text-gray-900 placeholder-gray-600 bg-white border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none @error('name') border-red-500 @enderror"
                            />
                            @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="sr-only">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="Email Address"
                                value="{{ old('email') }}"
                                class="block w-full px-6 py-4 text-base text-center text-gray-900 placeholder-gray-600 bg-white border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none @error('email') border-red-500 @enderror"
                            />
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Faculty -->
                        <div>
                            <label for="faculty" class="sr-only">Faculty</label>
                            <input
                                type="text"
                                name="faculty"
                                id="faculty"
                                placeholder="Faculty"
                                value="{{ old('faculty') }}"
                                class="block w-full px-6 py-4 text-base text-center text-gray-900 placeholder-gray-600 bg-white border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none @error('faculty') border-red-500 @enderror"
                            />
                            @error('faculty')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dormitory (Camin) -->
                        <div>
                            <label for="camin" class="sr-only">Dormitory (Camin)</label>
                            <input
                                type="text"
                                name="camin"
                                id="camin"
                                placeholder="Dormitory (Camin)"
                                value="{{ old('camin') }}"
                                class="block w-full px-6 py-4 text-base text-center text-gray-900 placeholder-gray-600 bg-white border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none @error('camin') border-red-500 @enderror"
                            />
                            @error('camin')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Floor -->
                        <div>
                            <label for="floor" class="sr-only">Floor</label>
                            <input
                                type="number"
                                name="floor"
                                id="floor"
                                placeholder="Floor"
                                value="{{ old('floor') }}"
                                class="block w-full px-6 py-4 text-base text-center text-gray-900 placeholder-gray-600 bg-white border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none @error('floor') border-red-500 @enderror"
                            />
                            @error('floor')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Room -->
                        <div>
                            <label for="room" class="sr-only">Room</label>
                            <input
                                type="text"
                                name="room"
                                id="room"
                                placeholder="Room"
                                value="{{ old('room') }}"
                                class="block w-full px-6 py-4 text-base text-center text-gray-900 placeholder-gray-600 bg-white border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none @error('room') border-red-500 @enderror"
                            />
                            @error('room')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Password"
                                class="block w-full px-6 py-4 text-base text-center text-gray-900 placeholder-gray-600 bg-white border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none @error('password') border-red-500 @enderror"
                            />
                            @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="sr-only">Confirm Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                placeholder="Confirm Password"
                                class="block w-full px-6 py-4 text-base text-center text-gray-900 placeholder-gray-600 bg-white border border-gray-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none"
                            />
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center w-full px-6 py-4 text-base font-medium text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700"
                            >
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
