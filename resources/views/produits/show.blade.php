@extends('layouts.app')

@section('title', 'Détails du Produit')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('admin.produits.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i> Retour à la liste des produits
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex">
        
                <!-- image principale du produit -->
                <div class="flex items-center justify-center p-8 w-full md:w-[600px] lg:w-[700px]">
                    <img class="h-96  object-cover rounded-lg border" src="{{ $produit->image_principale }}" alt="{{ $produit->nom }}">
                </div>
                <!-- <div class="flex items-center justify-center p-8">
                    <img class="h-96 w-96 object-cover rounded-lg border" src="{{ $produit->image_principale }}" alt="{{ $produit->nom }}">
                </div> -->
                
                

                <!-- Informations du produit -->
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-primary-600 font-semibold">
                        {{ $produit->categorie->nom ?? 'Sans catégorie' }}
                    </div>
                    <h1 class="block mt-1 text-3xl leading-tight font-bold text-gray-900">
                        {{ $produit->nom }}
                    </h1>
                    
                    <p class="mt-4 text-gray-600 text-lg">
                        {{ $produit->description }}
                    </p>

                    <div class="mt-6">
                        <span class="text-3xl font-bold text-primary-600">
                            {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
                        </span>
                    </div>

                    <div class="mt-6 border-t pt-6">
                        <p class="text-sm text-gray-500">Stock disponible : <strong>{{ $produit->stock }}</strong></p>
                        <p class="text-sm text-gray-500">Ajouté le : {{ $produit->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="mt-8 flex space-x-3">
                        <a href="{{ route('admin.produits.edit', $produit->id) }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                            Modifier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
