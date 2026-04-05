{{-- affichage des produits --}}
@extends('layouts.app')
@section('title', 'Nos Produits')
@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">
            <i class="fas fa-boxes text-primary-600 mr-2"></i>
            Nos Produits
        </h1>
        @if($produits->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($produits as $produit)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produit->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produit->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($produit->prix, 2) }} €</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $produit->stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-600">Aucun produit disponible.</p>
        @endif
    </div>
</div>
@endsection