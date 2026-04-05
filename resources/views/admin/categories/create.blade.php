@extends('layouts.app')

@section('title', 'Nouvelle Catégorie')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}" 
               class="text-primary-600 hover:text-primary-700 font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Nouvelle Catégorie</h1>
        
        <form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white rounded-xl shadow-md p-8">
            @csrf
            
            <div class="space-y-6">
                <!-- Nom -->
                <div>
                    <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nom de la catégorie <span class="text-red-600">*</span>
                    </label>
                    <input type="text" 
                           id="nom" 
                           name="nom" 
                           value="{{ old('nom') }}" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nom') border-red-500 @enderror">
                    @error('nom')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Décrivez brièvement cette catégorie</p>
                </div>
                
                <!-- URL Image -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                        URL de l'image
                    </label>
                    <input type="text" 
                           id="image" 
                           name="image" 
                           value="{{ old('image', 'https://via.placeholder.com/400x300?text=Categorie') }}"
                           placeholder="https://example.com/image.jpg"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">URL complète de l'image de la catégorie</p>
                </div>
                
                <!-- Statut actif -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="actif" 
                           name="actif" 
                           checked
                           class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="actif" class="ml-2 block text-sm font-semibold text-gray-700">
                        Catégorie active
                    </label>
                </div>
                <p class="text-xs text-gray-500 -mt-4 ml-6">
                    Les catégories inactives ne seront pas visibles sur le site
                </p>
            </div>
            
            <!-- Boutons -->
            <div class="mt-8 flex space-x-4">
                <button type="submit" 
                        class="bg-primary-600 text-white px-8 py-3 rounded-lg hover:bg-primary-700 transition font-semibold">
                    <i class="fas fa-save mr-2"></i>
                    Enregistrer
                </button>
                <a href="{{ route('admin.categories.index') }}" 
                   class="bg-gray-300 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-400 transition font-semibold">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection


