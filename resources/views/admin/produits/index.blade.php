@extends('layouts.app')

@section('title', 'Produits admin')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Produits</h1>
        <a href="{{ route('admin.produits.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded">Ajouter</a>
    </div>
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100"><tr><th class="p-3 text-left">Nom</th><th class="p-3">Categorie</th><th class="p-3">Prix</th><th class="p-3">Stock</th><th></th></tr></thead>
            <tbody>
            @foreach($produits as $produit)
            <tr class="border-t">
                <td class="p-3">{{ $produit->nom }}</td>
                <td class="p-3">{{ $produit->categorie->nom ?? '-' }}</td>
                <td class="p-3">{{ number_format($produit->prix, 2) }}</td>
                <td class="p-3">{{ $produit->stock }}</td>
                <td class="p-3 text-right"><a href="{{ route('admin.produits.edit', $produit->id) }}" class="text-blue-600">Editer</a></td>
                

                <!-- <td class="p-3 text-right"><a href="{{ route('admin.produits.destroy', $produit->id) }}" class="text-red-600">Supprimer</a></td> -->
                 <!-- delete produit -->
               <td class="p-3 text-right">  <form action="{{ route('admin.produits.destroy', $produit->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-700">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $produits->links() }}</div>
</div>
<!-- delete produit -->

@endsection
