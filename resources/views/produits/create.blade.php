{{-- créer un nouveau produit --}}

@extends('layouts.app')
@section('title', 'Créer un Nouveau Produit')
@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">
            <i class="fas fa-boxes text-primary-600 mr-2"></i>
            Créer un Nouveau Produit 
        </h1>
        <div class="bg-white rounded-xl shadow-md p-8">
            <form action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom du Produit</label>
                    <input type="text" name="nom" id="nom" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" 
                           required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" 
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"></textarea>
                </div>
                <div class="mb-4">
                    <label for="prix" class="block text-sm font-medium text-gray-700">Prix (€)</label>
                    <input type="number" name="prix" id="prix" step="0.01" min="0"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" 
                           required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock" min="0"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm" 
                           required>
                </div>
                <div class="mb-6">
                    <button type="submit" 
                            class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-save mr-2"></i> Enregistrer
                    </button>
                    <a href="{{ route('admin.produits.index') }}" 
                       class="ml-4 bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection