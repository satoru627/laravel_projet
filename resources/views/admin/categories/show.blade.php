@extends('layouts.app')

@section('title', 'Categorie')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-4">{{ $categorie->nom }}</h1>
    <p class="mb-4">{{ $categorie->description }}</p>
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100"><tr><th class="p-3 text-left">Produit</th><th class="p-3 text-left">Prix</th><th class="p-3 text-left">Stock</th></tr></thead>
            <tbody>
            @foreach($produits as $produit)
                <tr class="border-t">
                    <td class="p-3">{{ $produit->nom }}</td>
                    <td class="p-3">{{ number_format($produit->prix, 2) }}</td>
                    <td class="p-3">{{ $produit->stock }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
