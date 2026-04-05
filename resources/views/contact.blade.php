@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="max-w-2xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">Contactez-nous</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="#">
        @csrf
        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 @error('nom') border-red-500 @enderror">
            @error('nom')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 @error('email') border-red-500 @enderror">
            @error('email')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="message" class="block text-gray-700 font-semibold mb-2">Message</label>
            <textarea name="message" id="message" rows="5"
                class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
            @error('message')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-6 py-2 rounded shadow">
            Envoyer
        </button>
    </form>
</div>
@endsection