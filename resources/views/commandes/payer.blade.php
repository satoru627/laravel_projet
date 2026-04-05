@section('title', 'Payer votre commande')
@extends('layouts.app')
@section('content')
    <div class="max-w-md mx-auto py-10">
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Payer votre commande</h2>
            <p class="mb-3">Veuillez effectuer un paiement via Orange Money ou MTN Mobile Money en utilisant l'un des numéros ci-dessous :</p>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-orange-600">Orange Money</label>
                <input type="text" class="w-full border rounded p-2 bg-gray-50" value="Numero: 691466742" readonly>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-yellow-500">MTN Mobile Money</label>
                <input type="text" class="w-full border rounded p-2 bg-gray-50" value="Numero: 674725616" readonly>
            </div>
            <div class="mt-6 text-sm text-gray-600">
                <p>Après paiement, veuillez confirmer auprès du service client pour la validation de votre commande.</p>
            </div>
        <div class="mt-6 flex justify-center">
            <a href="{{ route('commande.liste') }}" class="bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-6 rounded transition">
                J'ai payé, terminer la transaction
            </a>
        </div>
        </div>
    </div>  
@endsection