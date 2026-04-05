@extends('layouts.app')

@section('title', 'Produit admin')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-4">{{ $produit->nom }}</h1>
    <p class="mb-2">{{ $produit->description }}</p>
    <p>Prix: {{ number_format($produit->prix, 2) }}</p>
    <p>Stock: {{ $produit->stock }}</p>
</div>
@endsection
