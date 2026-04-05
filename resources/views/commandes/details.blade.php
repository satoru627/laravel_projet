@extends('layouts.app')

@section('title', 'Details commande')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-2">Commande {{ $commande->numero_commande }}</h1>
    <p class="text-gray-600 mb-6">Statut: {{ $commande->statut }} | Paiement: {{ $commande->payment_status }}</p>

    <div class="bg-white rounded shadow p-4 mb-4">
        @foreach($commande->details as $detail)
            <div class="flex justify-between border-b py-2">
                <span>{{ $detail->produit->nom ?? 'Produit' }} x{{ $detail->quantite }}</span>
                <span>{{ number_format($detail->sous_total, 2) }}</span>
            </div>
        @endforeach
        <div class="flex justify-between mt-3">
            <span>Livraison</span>
            <span>{{ number_format($commande->shipping_total, 2) }}</span>
        </div>
        <div class="flex justify-between font-bold text-lg mt-2">
            <span>Total</span>
            <span>{{ number_format($commande->total, 2) }}</span>
        </div>
    </div>

    @if($commande->payment_status === 'pending')
    <div class="bg-yellow-50 border border-yellow-300 rounded p-4">
        <p class="mb-3">Paiement en attente. Cliquez pour finaliser le paiement Orange ou MTN money.</p>
        <button id="paypalPayBtn" class="bg-primary-600 text-white px-4 py-2 rounded" onclick="window.location.href='{{ route('commande.payer') }}'">Payer avec Orange ou MTN money</button>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<!-- <script>
document.getElementById('paypalPayBtn')?.addEventListener('click', async () => {
    const orderRes = await fetch('{{ route('paypal.create-order', $commande->id) }}', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}
    });
    if (!orderRes.ok) return alert('Impossible de creer la commande PayPal');
    const captureRes = await fetch('{{ route('paypal.capture-order', $commande->id) }}', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}
    });
    if (!captureRes.ok) return alert('Paiement echoue');
    window.location.reload();
});
</script> -->
@endpush
