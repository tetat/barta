@extends('layouts.app')

@section('content')

<div class="flex min-h-full flex-col justify-center px-6 pb-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
    <a
        href="{{ route('home') }}"
        class="text-center text-4xl font-bold text-gray-900"
        ><h1>Barta</h1></a
    >
    <h1
        class="mt-1 text-center text-xl font-bold leading-9 tracking-tight text-gray-900">
        Create a new account
    </h1>
    </div>

    <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
        @if (session()->has('error'))
            <p class="text-red-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('error') }}</p>
        @enderror
    <form
        class="space-y-2"
        action="{{ route('register') }}"
        method="POST" novalidate>

        @csrf

        <!-- First Name -->
        <div>
            <label
                for="first_name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >First Name</label
            >
            <div class="mt-2">
                <input
                id="first_name"
                name="first_name"
                type="text"
                autocomplete="given-name"
                placeholder="Write you first name"
                value="{{ old('first_name') }}"
                required
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
            @error('first_name')
                <small class="text-red-700">{{$message}}</small>
            @enderror
        </div>

        <!-- Last Name -->
        <div>
            <label
                for="last_name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Last Name</label
            >
            <div class="mt-2">
                <input
                id="last_name"
                name="last_name"
                type="text"
                autocomplete="family-name"
                placeholder="Write you surname"
                value="{{ old('last_name') }}"
                required
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
            @error('last_name')
                <small class="text-red-700">{{$message}}</small>
            @enderror
        </div>

        <!-- User Name -->
        <div>
            <label
                for="user_name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >User Name</label
            >
            <div class="mt-2">
                <input
                id="user_name"
                name="user_name"
                type="text"
                autocomplete="user_name"
                placeholder="alparslan1029"
                value="{{ old('user_name') }}"
                required
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
            @error('user_name')
                <small class="text-red-700">{{$message}}</small>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label
                for="email"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Email address</label
            >
            <div class="mt-2">
                <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                placeholder="alp.arslan@mail.com"
                value="{{ old('email') }}"
                required
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
            @error('email')
                <small class="text-red-700">{{$message}}</small>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label
                for="password"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Password</label
            >
            <div class="mt-2">
                <input
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                placeholder="••••••••"
                required
                class="block w-full rounded-md border-0 p-2 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
            @error('password')
                <small class="text-red-700">{{$message}}</small>
            @enderror
        </div>
        <!-- Confirm Password -->
        <div>
            <label
                for="password_confirmation"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Re-type Password</label
            >
            <div class="mt-2">
                <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="current-password"
                placeholder="••••••••"
                required
                class="block w-full rounded-md border-0 p-2 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-black sm:text-sm sm:leading-6" />
            </div>
        </div>

        <div>
        <button
            type="submit"
            class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">
            Register
        </button>
        </div>
    </form>

    <p class="mt-10 text-center text-sm text-gray-500">
        Already a member?
        <a
        href="{{ route('login') }}"
        class="font-semibold leading-6 text-black hover:text-black"
        >Sign In</a
        >
    </p>
    </div>
</div>

@endsection