@extends('layouts.app')

@section('content')

    @if (session()->has('success'))
        <p class="text-green-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('success') }}</p>
    @endif

    @if (session()->has('error'))
        <p class="text-red-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('error') }}</p>
    @enderror

    <div class="text-center p-12 border border-gray-800 rounded-xl">
        <h1 class="text-3xl justify-center items-center">Welcome to Barta!</h1>
    </div>

    <!-- Barta Create Post Card -->
    @auth
        @include('posts.create-form')
    @endauth
    <!-- /Barta Create Post Card -->

    <!-- Newsfeed -->

    @include('posts.index')

    <!-- /Newsfeed -->

@endsection