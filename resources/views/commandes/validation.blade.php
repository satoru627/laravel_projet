@extends('layouts.app')

@section('title', 'Validation commande')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Validation de votre commande</h1>
    <form method="POST" action="{{ route('commande.confirmer') }}" class="grid md:grid-cols-2 gap-6">
        @csrf
        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-semibold mb-3">Adresse de livraison</h2>
            <input name="adresse" class="w-full border rounded p-2 mb-2" placeholder="Adresse" required>
            <input name="ville" class="w-full border rounded p-2 mb-2" placeholder="Ville" required>
            <input name="code_postal" class="w-full border rounded p-2 mb-2" placeholder="Code postal" required>
            <input name="telephone" class="w-full border rounded p-2 mb-2" placeholder="Telephone" required>
            <textarea name="notes" class="w-full border rounded p-2" placeholder="Notes"></textarea>
            <select name="shipping_method_id" class="w-full border rounded p-2 mt-3" required>
                @foreach($shippingMethods as $method)
                    <option value="{{ $method->id }}">orange/MTN</option> 
            
                        
                @endforeach
            </select> 
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h2 class="font-semibold mb-3">Recapitulatif</h2>
            @foreach($produits as $item)
                <div class="flex justify-between border-b py-2">
                    <span>{{ $item['produit']->nom }} x{{ $item['quantite'] }}</span>
                    <span>{{ number_format($item['sous_total'], 2) }}</span>
                </div>
            @endforeach
            <div class="flex justify-between mt-3 font-bold">
                <span>Sous-total</span>
                <span>{{ number_format($total, 2) }}</span>
            </div>
            <button class="mt-4 w-full bg-primary-600 text-white rounded p-2">Creer la commande</button>
        </div>
    </form>
</div>
@endsection
