@extends('layouts.app')

@section('content')
    <section class="py-12 sm:py-16 lg:py-20 xl:py-24 bg-gray-50">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
                    Sign in to your account
                </h2>
                <p class="mt-4 text-base font-normal leading-7 text-gray-600 lg:text-lg lg:mt-6 lg:leading-8">
                    Clarity gives you the blocks and components you need to create a truly professional website.
                </p>
            </div>

            <div class="max-w-lg mx-auto mt-8 bg-white shadow-xl rounded-2xl sm:mt-12">
                <div class="p-6 sm:px-8">
                    @if(Session::has('success'))
                        <div class="mb-4 p-4 text-center bg-green-100 text-green-700 rounded-lg">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <form action="{{ route('authenticate') }}" method="POST" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="sr-only">Email address</label>
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

                        <div class="flex items-center justify-between">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input
                                        type="checkbox"
                                        name="remember"
                                        id="remember"
                                        class="w-4 h-4 text-blue-600 border border-gray-200 rounded focus:outline-none focus:ring-blue-600"
                                    />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-sm font-normal text-gray-700">
                                        Remember me
                                    </label>
                                </div>
                            </div>

{{--                            <a href="{{ route('password.request') }}" class="text-sm font-normal text-gray-900 hover:underline">--}}
{{--                                Forgot password?--}}
{{--                            </a>--}}
                            <a class="text-sm font-normal text-gray-900 hover:underline">
                                Forgot password?
                            </a>
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center w-full px-6 py-4 text-base font-medium text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-700"
                        >
                            Sign In
                        </button>
                    </form>

                    <div class="mt-6 space-y-6 text-center">
                        <p class="text-sm font-normal text-gray-500">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                                Sign up
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
