@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded">Ajouter</a>
    </div>
    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100"><tr><th class="p-3 text-left">Nom</th><th class="p-3 text-left">Produits</th><th class="p-3 text-left">Actif</th><th></th></tr></thead>
            <tbody>
            @foreach($categories as $categorie)
                <tr class="border-t">
                    <td class="p-3">{{ $categorie->nom }}</td>
                    <td class="p-3">{{ $categorie->produits_count }}</td>
                    <td class="p-3">{{ $categorie->actif ? 'Oui' : 'Non' }}</td>
                    <td class="p-3 text-right">
                        <a href="{{ route('admin.categories.show', $categorie->id) }}" class="text-primary-600">Voir</a>
                        <a href="{{ route('admin.categories.edit', $categorie->id) }}" class="ml-3 text-blue-600">Editer</a><br>
                        <br>
                        <form action="{{ route('admin.categories.destroy', $categorie->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')" style="margin-top: 10px;"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $categories->links() }}</div>
</div>
@endsection
