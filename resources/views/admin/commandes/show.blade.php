@extends('layouts.app')

@section('title', 'Commande admin')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    
    <p class="mb-4">
       <div class="bg-white rounded shadow p-4">
        <h1 class="text-2xl font-bold mb-3">{{ $commande->numero_commande }}</h1>
        <p class="mb-4"><span class="text-lg font-bold mb-2">Client:</span> {{ $commande->user->nom }} {{ $commande->user->prenom }}</p>
        <p class="mb-4"><span class="text-lg font-bold mb-2">Telephone de livraison:</span>{{ $commande->telephone_livraison }}</p>
        <p class="mb-4"><span class="text-lg font-bold mb-2">Ville de livraison:</span> {{ $commande->ville_livraison }}</p>
        <p class="mb-4"><span class="text-lg font-bold mb-2">Statut:</span> {{ $commande->statut }}</p>
        <!-- <p class="mb-4">Date de paiement: {{ $commande->date }}</p> -->
        <h2 class="text-lg font-bold mb-2">Notes</h2>
        <p>{{ $commande->notes }}</p>
       </div>
    </p><br>
    <form method="POST" action="{{ route('admin.commandes.statut', $commande->id) }}" class="mb-4">
        @csrf
        <select name="statut" class="border rounded p-2">
            @foreach(['en_attente','confirmee','en_preparation','expediee','livree','annulee','failed'] as $st)
                <option value="{{ $st }}" @selected($commande->statut === $st)>{{ $st }}</option>
            @endforeach
        </select>
        <button class="bg-primary-600 text-white px-3 py-2 rounded">Mettre a jour</button>
    </form>
    <div class="bg-white rounded shadow p-4">
        @foreach($commande->details as $detail)
            <div class="flex justify-between border-b py-2">
                <span>{{ $detail->produit->nom ?? '-' }} x{{ $detail->quantite }}</span>
                <span>{{ number_format($detail->sous_total, 2) }}</span>
            </div>
        @endforeach
    </div>
</div>
@endsection
