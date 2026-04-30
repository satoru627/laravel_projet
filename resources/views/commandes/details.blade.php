@extends('layouts.app')

@section('title', 'Détails commande')

@section('content')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
@endpush

<div style="background:#F5F5F5; font-family:'Poppins',sans-serif; min-height:100vh; padding:24px 16px 60px;">
<div class="max-w-3xl mx-auto">

    {{-- ─── Header ─── --}}
    <div class="mb-6">
        <a href="{{ route('commande.liste') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold mb-4"
           style="color:#E8184A;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Mes commandes
        </a>
        <h1 class="text-2xl font-extrabold text-gray-900">
            Commande <span style="color:#E8184A;">{{ $commande->numero_commande }}</span>
        </h1>
    </div>

    {{-- ─── Badges statut ─── --}}
    <div class="flex flex-wrap gap-3 mb-6">
        {{-- Statut commande --}}
        @php
            $statutColors = [
                'en_attente'  => ['bg'=>'#FFF7ED','text'=>'#C2410C','border'=>'#FED7AA'],
                'confirmee'   => ['bg'=>'#F0FDF4','text'=>'#15803D','border'=>'#BBF7D0'],
                'livree'      => ['bg'=>'#EFF6FF','text'=>'#1D4ED8','border'=>'#BFDBFE'],
                'annulee'     => ['bg'=>'#FFF1F2','text'=>'#BE123C','border'=>'#FECDD3'],
            ];
            $sc = $statutColors[$commande->statut] ?? ['bg'=>'#F5F5F5','text'=>'#555','border'=>'#e0e0e0'];
        @endphp
        <span class="text-xs font-bold px-3 py-1.5 rounded-full"
              style="background:{{ $sc['bg'] }}; color:{{ $sc['text'] }}; border:1.5px solid {{ $sc['border'] }};">
            📦 {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
        </span>

        {{-- Statut paiement --}}
        @php
            $payColors = [
                'pending' => ['bg'=>'#FFFBEB','text'=>'#B45309','border'=>'#FDE68A'],
                'paid'    => ['bg'=>'#F0FDF4','text'=>'#15803D','border'=>'#BBF7D0'],
                'failed'  => ['bg'=>'#FFF1F2','text'=>'#BE123C','border'=>'#FECDD3'],
            ];
            $pc = $payColors[$commande->payment_status] ?? ['bg'=>'#F5F5F5','text'=>'#555','border'=>'#e0e0e0'];
        @endphp
        <span class="text-xs font-bold px-3 py-1.5 rounded-full"
              style="background:{{ $pc['bg'] }}; color:{{ $pc['text'] }}; border:1.5px solid {{ $pc['border'] }};">
            💳 {{ ucfirst($commande->payment_status) }}
        </span>
    </div>

    {{-- ─── Liste des produits ─── --}}
    <div class="rounded-2xl overflow-hidden mb-4" style="background:#fff; border:1.5px solid #e8e8e8;">

        <div class="px-5 py-4" style="border-bottom:1.5px solid #f0f0f0;">
            <h2 class="font-bold text-gray-900 text-base">Articles commandés</h2>
        </div>

        @foreach($commande->details as $detail)
        <div class="flex items-center justify-between px-5 py-4" style="border-bottom:1px solid #f5f5f5;">
            <div class="flex items-center gap-3">
                {{-- Miniature produit --}}
                <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,#fff0f3,#fce4ec);">
                    @if(isset($detail->produit->image) && $detail->produit->image)
                        <img src="{{ Storage::url($detail->produit->image) }}"
                             class="w-full h-full object-cover rounded-xl" alt="">
                    @else
                        <svg class="w-5 h-5 opacity-30" fill="none" stroke="#E8184A" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
                        </svg>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ $detail->produit->nom ?? 'Produit supprimé' }}</p>
                    <p class="text-xs" style="color:#aaa;">Qté : {{ $detail->quantite }}</p>
                </div>
            </div>
            <p class="text-sm font-bold" style="color:#E8184A;">
                {{ number_format($detail->sous_total, 0, ',', ' ') }} FCFA
            </p>
        </div>
        @endforeach

        {{-- Livraison + Total --}}
        <div class="px-5 py-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm" style="color:#888;">Livraison</span>
                <span class="text-sm font-semibold text-gray-700">
                    {{ number_format($commande->shipping_total, 0, ',', ' ') }} FCFA
                </span>
            </div>
            <div class="flex justify-between items-center pt-3" style="border-top:1.5px solid #f0f0f0;">
                <span class="text-base font-bold text-gray-900">Total</span>
                <span class="text-xl font-extrabold" style="color:#E8184A;">
                    {{ number_format($commande->total, 0, ',', ' ') }} FCFA
                </span>
            </div>
        </div>
    </div>

    {{-- ─── Bloc paiement en attente ─── --}}
    @if($commande->payment_status === 'pending')
    <div class="rounded-2xl p-5" style="background:#fff; border:1.5px solid #FED7AA;">

        <div class="flex items-start gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:#FFF7ED;">
                <svg class="w-5 h-5" fill="none" stroke="#C2410C" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-sm" style="color:#C2410C;">Paiement en attente</p>
                <p class="text-xs mt-0.5" style="color:#92400E;">
                    Finalisez votre paiement via Orange Money ou MTN Money.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            {{-- Orange Money --}}
            <a href="{{ route('commande.payer') }}"
               class="flex items-center justify-center gap-2 py-3 rounded-xl font-bold text-sm transition-all hover:opacity-90"
               style="background:#FF6600; color:#fff;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                Orange Money
            </a>
            {{-- MTN Money --}}
            <a href="{{ route('commande.payer') }}"
               class="flex items-center justify-center gap-2 py-3 rounded-xl font-bold text-sm transition-all hover:opacity-90"
               style="background:#F5A623; color:#fff;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                MTN Money
            </a>
        </div>
    </div>
    @endif

</div>
</div>

@endsection

@push('scripts')
{{-- Script PayPal commenté conservé --}}
@endpush