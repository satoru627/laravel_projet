{{-- gestion des catégories --}}
@extends('layouts.app')
@section('title', 'Gestion des Catégories')
@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">
            <i class="fas fa-tags text-primary-600 mr-2"></i>
            Gestion des Catégories
        </h1>
        
        <div class="mb-6">
            <a href="{{ route('admin.categories.create') }}" 
               class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                <i class="fas fa-plus mr-2"></i>
                Nouvelle Catégorie
            </a>
        </div>
        
        @if($categories->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($categories as $categorie)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $categorie->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $categorie->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($categorie->description, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <!-- Actions (Edit/Delete) -->
                                    <a href="{{ route('admin.categories.edit', $categorie->id) }}" 
                                       class="text-primary-600 hover:text-primary-700 mr-4">
                                        <i class="fas fa-edit"></i> Editer 
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $categorie->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-700"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <p class="text-gray-500">Aucune catégorie trouvée.</p>
            </div>
        @endif
    </div>
</div>
@endsection
