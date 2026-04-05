@extends('layouts.app')

@section('title', 'Mon panier')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Mon panier</h1>
    @if(count($produits))
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                <tr><th class="p-3 text-left">Produit</th><th class="p-3 text-left">Qt</th><th class="p-3 text-left">Sous-total</th><th></th></tr>
                </thead>
                <tbody>
                @foreach($produits as $item)
                    <tr class="border-t">
                        <td class="p-3">{{ $item['produit']->nom }}</td>
                        <td class="p-3">{{ $item['quantite'] }}</td>
                        <td class="p-3">{{ number_format($item['sous_total'], 2) }}</td>
                        <td class="p-3"><form method="POST" action="{{ route('panier.supprimer', $item['produit']->id) }}">@csrf @method('DELETE') <button class="text-red-600">Retirer</button></form></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-right mt-4">
            <p class="font-bold text-lg mb-2">Total: {{ number_format($total, 2) }}</p>
            <a href="{{ route('commande.validation') }}" class="bg-primary-600 text-white px-4 py-2 rounded">Passer au checkout</a>
        </div>
    @else
        <p>Votre panier est vide.</p>
    @endif
</div>
@endsection
