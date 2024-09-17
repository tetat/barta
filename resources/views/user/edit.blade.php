@extends('layouts.app')

@section('content')

<!-- Profile Edit Form -->


@if (session()->has('success'))
    <p class="text-green-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('success') }}</p>
@endif

@if (session()->has('error'))
    <p class="text-red-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('error') }}</p>
@enderror


<form action="{{ route('user.update', $id) }}" method="POST" novalidate>
    
    @csrf
    @method('PATCH')

    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-xl font-semibold leading-7 text-gray-900">
            Edit Profile
        </h2>
        <p class="mt-1 text-base leading-6 text-gray-600">
            This information will be displayed publicly so be careful what you
            share.
        </p>

        <p class="mt-1 text-sm leading-6 text-amber-500">
            * Current password and missing fields must be needed!
        </p>

        <div class="mt-10 border-b border-gray-900/10 pb-12">

            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label
                for="first-name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >First name</label
                >
                <div class="mt-2">
                <input
                    type="text"
                    name="firstName"
                    id="firstName"
                    autocomplete="given-name"
                    value="{{ auth()->user()->firstName }}"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                </div>
                @error('firstName')
                    <small class="text-red-700">{{$message}}</small>
                @enderror
            </div>

            <div class="sm:col-span-3">
                <label
                for="last-name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Last name</label
                >
                <div class="mt-2">
                <input
                    type="text"
                    name="lastName"
                    id="lastName"
                    value="{{ auth()->user()->lastName }}"
                    autocomplete="family-name"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                </div>
                @error('lastName')
                    <small class="text-red-700">{{$message}}</small>
                @enderror
            </div>

            <div class="col-span-full">
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
                    value="{{ auth()->user()->email }}"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                </div>
                @error('email')
                    <small class="text-red-700">{{$message}}</small>
                @enderror
            </div>

            <div class="col-span-full">
                <label
                for="gender"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Gender</label
                >
                <div class="mt-2">
                    <select id="gender" name="gender" class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">
                        <option selected>Select your gender</option>
                        <option @selected( auth()->user()->gender === 'male' ) value="male">Male</option>
                        <option @selected( auth()->user()->gender === 'female' ) value="female">Female</option>
                        <option @selected( auth()->user()->gender === 'other' ) value="other">Other</option>
                    </select>
                </div>
                @error('gender')
                    <small class="text-red-700">{{$message}}</small>
                @enderror
            </div>

            <div class="col-span-full">
                <label
                for="current_password"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Current Password</label
                >
                <div class="mt-2">
                <input
                    type="password"
                    name="current_password"
                    id="current_password"
                    placeholder="••••••••"
                    autocomplete="password"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                </div>
                @error('current_password')
                    <small class="text-red-700">{{$message}}</small>
                @enderror
            </div>

            <div class="col-span-full">
                <p class="mt-1 py-2 text-sm leading-6 border-y">
                    * Leave below password fields empty if you don't want to change your password.
                </p>
            </div>

            <div class="col-span-full">
                <label
                for="password"
                class="block text-sm font-medium leading-6 text-gray-900"
                >New Password</label
                >
                <div class="mt-2">
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="••••••••"
                    autocomplete="password"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                </div>
                @error('password')
                    <small class="text-red-700">{{$message}}</small>
                @enderror
            </div>
            <div class="col-span-full">
                <label
                for="password_confirmation"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Re-type New Password</label
                >
                <div class="mt-2">
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="••••••••"
                    autocomplete="password"
                    class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6" />
                </div>
            </div>
            </div>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
            <label
                for="bio"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Bio</label
            >
            <div class="mt-2">
                <textarea
                id="bio"
                name="bio"
                rows="3"
                class="block w-full rounded-md border-0 p-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-gray-600 sm:text-sm sm:leading-6">{{ auth()->user()->bio }}</textarea
                >
                @error('bio')
                    <small class="text-red-700">{{$message}}</small>
                @enderror
            </div>
            <p class="mt-3 text-sm leading-6 text-gray-600">
                Write a few sentences about yourself.
            </p>
            </div>
        </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a
        href="{{ url()->previous() }}"
        class="text-sm font-semibold leading-6 text-gray-900">
        Cancel
        </a>
        <button
        type="submit"
        class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
        Save
        </button>
    </div>
    </form>
    <!-- /Profile Edit Form -->

@endsection