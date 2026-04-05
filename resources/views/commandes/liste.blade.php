@extends('layouts.app')

@section('title', 'Mes commandes')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Mes commandes</h1>
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Numero</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Statut</th>
                    <th class="p-3 text-left">Paiement</th>
                    <th class="p-3 text-left"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($commandes as $commande)
                <tr class="border-t">
                    <td class="p-3">{{ $commande->numero_commande }}</td>
                    <td class="p-3">{{ number_format($commande->total, 2) }}</td>
                    <td class="p-3">{{ $commande->statut }}</td>
                    <td class="p-3">{{ $commande->payment_status }}</td>
                    <td class="p-3"><a class="text-primary-600" href="{{ route('commande.details', $commande->id) }}">Voir</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="p-4">Aucune commande.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $commandes->links() }}</div>
</div>
@endsection
