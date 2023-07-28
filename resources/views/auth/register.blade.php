@extends('template.main')

@section('content')
    <div class="row vh-100">
        <div class="d-flex align-items-end col-6 p-0 vh-100">
            <div class="m-5 z-3" style="position: fixed;">
                <h1 class="fw-bold text-primary">SKY &nbsp;</h1>
                <h1 class="fw-bold text-white">UNIVERSE Lt.</h1>
            </div>
            <img src="img/bg.jpeg" class="img-fluid vh-100 object-fit-cover" style="position: fixed; width:50%">
        </div>
        <div class="col-6 p-0 align-items-center justify-content-center">
            <div class="container p-5 border-black">
                <h1 class="fw-bold mb-4 text-primary">Register Now</h1>
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full name</label>
                        <input value="{{  old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Your Full Name" required>
                        @error('name')
                            <div id="name" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="datingCode" class="form-label">Dating Code</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">DT</span>
                            <input value="{{  old('datingCode') }}"name="datingCode" type="text" class="form-control @error('datingCode') is-invalid @enderror @if(session()->has('failed')) is-invalid @endif" placeholder="Enter 3 Digit" aria-label="datingCode" required>
                            @if(session()->has('failed'))
                                <div id="datingCode" class="invalid-feedback">
                                    {{ session()->get('failed') }}
                                </div>
                            @endif
                            @error('datingCode')
                                <div id="datingCode" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="birthDate" class="form-label">Birth Date</label>
                        <input value="{{  old('birthDate') }}" name="birthDate" type="date" class="form-control @error('birthDate') is-invalid @enderror" id="birthDate" required>
                        @error('birthDate')
                            <div id="birthDate" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select value="{{  old('gender') }}" name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" aria-label="gender" required>
                            <option selected disabled>Select Your Gender</option>
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                        @error('gender')
                            <div id="gender" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input value="{{  old('email') }}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Your Email" required>
                        @error('email')
                            <div id="email" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">+62</span>
                            <input value="{{  old('phoneNumber') }}"name="phoneNumber" type="text" class="form-control @error('phoneNumber') is-invalid @enderror" placeholder="Enter Your Phone Number" aria-label="phoneNumber" required>
                            @error('phoneNumber')
                                <div id="phoneNumber" class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Your Photo</label>
                        <input class="form-control" type="file" id="image" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Your Password">
                        @error('password')
                            <div id="password" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex items-center mt-4 align-items-center justify-content-end">
                        <a class="me-4" href="{{ route('login') }}">
                            {{ __('Already Registered?') }}
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
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
