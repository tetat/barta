@extends('layouts.app')

@section('content')

@if (session()->has('success'))
    <p class="text-green-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('success') }}</p>
@endif

@if (session()->has('error'))
    <p class="text-red-800 font-bold bg-gray-300 text-center p-2 rounded-md shadow">{{ session()->get('error') }}</p>
@enderror

<form 
    class="max-w-sm mx-auto"
    action="{{ route('posts.update', $post->id) }}"
    method="POST">

    @csrf
    
    <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Update your post</label>
    <textarea id="body" name="body" rows="10" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $post->body }}</textarea>

    @error('body')
        <small class="text-red-700">{{ $message }}</small>
    @enderror

    <div class="p-2 text-right">
        <a class="text-white bg-gradient-to-r from-green-500 to-teal-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" href="{{ route('posts.show', $post->id) }}">Cancel</a>
        
        <button type="submit" class="text-white bg-gradient-to-r from-yellow-500 to-amber-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
        onclick="return confirm('Are you sure?')">Update</button>
    </div>
</form>

   
@endsection