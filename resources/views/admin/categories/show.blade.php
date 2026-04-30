@extends('layouts.app')

@section('title', 'Catégorie — {{ $categorie->nom }}')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-6xl mx-auto px-4">

        {{-- Retour --}}
        <div class="mb-6">
            <a href="{{ route('admin.categories.index') }}"
               class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Retour aux catégories
            </a>
        </div>

        {{-- Hero --}}
        <div class="flex items-center gap-4 mb-6">
            @if($categorie->image)
                <img src="{{ Storage::url($categorie->image) }}"
                     alt="{{ $categorie->nom }}"
                     class="w-16 h-16 rounded-xl object-cover border border-gray-100 flex-shrink-0">
            @else
                <div class="w-16 h-16 rounded-xl bg-gray-100 border border-gray-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            @endif
            <div>
                <h1 class="text-xl font-semibold text-gray-900">{{ $categorie->nom }}</h1>
                @if($categorie->description)
                    <p class="text-sm text-gray-500 mt-1">{{ $categorie->description }}</p>
                @endif
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="bg-white rounded-xl p-4">
                <p class="text-xs text-gray-400 mb-1">Produits</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $produits->total() }}</p>
            </div>
            <div class="bg-white rounded-xl p-4">
                <p class="text-xs text-gray-400 mb-1">Prix moyen</p>
                <p class="text-2xl font-semibold text-gray-900">
                    {{ number_format($produits->avg('prix'), 0, ',', ' ') }}
                </p>
            </div>
            <div class="bg-white rounded-xl p-4">
                <p class="text-xs text-gray-400 mb-1">Stock total</p>
                <p class="text-2xl font-semibold text-gray-900">
                    {{ $produits->sum('stock') }}
                </p>
            </div>
        </div>

        {{-- Table produits --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
            <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100">
                <p class="text-sm font-medium text-gray-700">Produits de la catégorie</p>
            </div>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Produit</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Prix (FCFA)</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Stock</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($produits as $produit)
                    <tr class="hover:bg-gray-50 transition-colors">

                        {{-- Produit --}}
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if($produit->image_principale)
                                    <img src="{{ Storage::url($produit->image_principale) }}"
                                         alt="{{ $produit->nom }}"
                                         class="w-8 h-8 rounded-lg object-cover border border-gray-100 flex-shrink-0">
                                @else
                                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <span class="font-medium text-sm text-gray-800">{{ $produit->nom }}</span>
                            </div>
                        </td>

                        {{-- Prix --}}
                        <td class="px-4 py-3 font-medium text-sm text-gray-800">
                            {{ number_format($produit->prix, 0, ',', ' ') }}
                        </td>

                        {{-- Stock avec couleur --}}
                        <td class="px-4 py-3 text-sm">
                            @if($produit->stock === 0)
                                <span class="text-red-500">Rupture</span>
                            @elseif($produit->stock <= 5)
                                <span class="text-amber-500">{{ $produit->stock }} en stock</span>
                            @else
                                <span class="text-green-600">{{ $produit->stock }} en stock</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($produits->hasPages())
                <div class="px-4 py-3 border-t border-gray-100">
                    {{ $produits->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection