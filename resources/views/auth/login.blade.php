@extends('template.main')

@section('content')
    <div class="row vh-100 align-items-center justify-content-center">
        <div class="d-flex align-items-end col-6 p-0 vh-100">
            <div class="m-5 z-3" style="position: fixed;">
                <h1 class="fw-bold text-primary">SKY &nbsp;</h1>
                <h1 class="fw-bold text-white">UNIVERSE Lt.</h1>
            </div>
            <img src="img/bg.jpeg" class="img-fluid vh-100 object-fit-cover" style="position: fixed; width:50%">
        </div>
        <div class="col-6 p-0">
            <div class="container p-5 border-black">
                <h1 class="fw-bold text-primary mb-4">Login</h1>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="credential" class="form-label">Email or User ID</label>
                        <input name="credential" type="text" class="form-control @error('credential') is-invalid @enderror" id="credential" placeholder="Enter Your Email or User ID" required>
                        @error('credential')
                            <div id="credential" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Enter Your Password">
                    </div>
                    <div class="mt-4 d-flex align-items-center justify-content-end">
                        <a class="me-4" href="{{ route('register') }}">
                            {{ __('Don\'t Have an Account?') }}
                        </a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        
        let navbar = document.getElementById('navbar');

        navbar.style.display = 'none';

    </script>
@endsection


{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
