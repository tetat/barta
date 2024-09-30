@extends('layouts.app')

@section('content')

    @if (session()->has('success'))
        <p class="text-green-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('success') }}</p>
    @endif

    @if (session()->has('error'))
        <p class="text-red-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('error') }}</p>
    @enderror

    <!-- Cover Container -->
    <section
        class="bg-white border-2 p-8 border-gray-800 rounded-xl min-h-[400px] space-y-8 flex items-center flex-col justify-center">
        <!-- Profile Info -->
        <div
            class="flex gap-4 justify-center flex-col text-center items-center">

            <!-- User Meta -->
            <div>
            <h1 class="font-bold md:text-2xl">{{ $user->firstName . ' ' . $user->lastName }}</h1>
            <p class="text-gray-700">{{ $user->bio }}</p>
            </div>
            <!-- / User Meta -->
        </div>
        <!-- /Profile Info -->

        <!-- Edit Profile Button (Only visible to the profile owner) -->
        @if (auth()->user()->id == $user->id)
            <a
                href="{{ route('profile.edit') }}"
                type="button"
                class="-m-2 flex gap-2 items-center rounded-full px-4 py-2 font-semibold bg-gray-100 hover:bg-gray-200 text-gray-700">
                <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-5 h-5">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
        
                Edit Profile
            </a>
        @endif
        <!-- /Edit Profile Button -->
    </section>
    <!-- /Cover Container -->

    <!-- Barta Create Post Card -->
    @if ($user->id === auth()->user()->id)
        @include('layouts.posts.store-form')
    @endif
    <!-- /Barta Create Post Card -->

    <!-- Newsfeed -->
    
    @include('layouts.posts.newsfeed')

    <!-- /Newsfeed -->

@endsection