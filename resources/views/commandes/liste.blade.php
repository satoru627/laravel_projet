@extends('layouts.app')

@section('title', 'Mes commandes')

@section('content')

<div style="background:#F5F5F5; font-family:'Poppins',sans-serif; min-height:100vh; padding:24px 16px 60px;">
<div class="max-w-3xl mx-auto">

    {{-- ─── Header ─── --}}
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-gray-900">
            Mes <span style="color:#E8184A;">Commandes</span>
        </h1>
        <p class="text-sm mt-1" style="color:#aaa;">Suivez l'état de toutes vos commandes</p>
    </div>

    {{-- ─── Liste ─── --}}
    @forelse($commandes as $commande)

    @php
        $statutColors = [
            'en_attente' => ['bg'=>'#FFF7ED','text'=>'#C2410C','border'=>'#FED7AA','icon'=>'⏳'],
            'confirmee'  => ['bg'=>'#F0FDF4','text'=>'#15803D','border'=>'#BBF7D0','icon'=>'✅'],
            'livree'     => ['bg'=>'#EFF6FF','text'=>'#1D4ED8','border'=>'#BFDBFE','icon'=>'📦'],
            'annulee'    => ['bg'=>'#FFF1F2','text'=>'#BE123C','border'=>'#FECDD3','icon'=>'❌'],
        ];
        $payColors = [
            'pending' => ['bg'=>'#FFFBEB','text'=>'#B45309','border'=>'#FDE68A'],
            'paid'    => ['bg'=>'#F0FDF4','text'=>'#15803D','border'=>'#BBF7D0'],
            'failed'  => ['bg'=>'#FFF1F2','text'=>'#BE123C','border'=>'#FECDD3'],
        ];
        $sc = $statutColors[$commande->statut] ?? ['bg'=>'#F5F5F5','text'=>'#555','border'=>'#e0e0e0','icon'=>'📋'];
        $pc = $payColors[$commande->payment_status] ?? ['bg'=>'#F5F5F5','text'=>'#555','border'=>'#e0e0e0'];
    @endphp

    <div class="rounded-2xl mb-3 overflow-hidden"
         style="background:#fff; border:1.5px solid #e8e8e8; box-shadow:0 1px 6px rgba(0,0,0,0.04);">

        {{-- Top : numéro + date --}}
        <div class="flex items-center justify-between px-5 py-4"
             style="border-bottom:1px solid #f5f5f5;">
            <div>
                <p class="text-xs font-semibold" style="color:#aaa;">Commande</p>
                <p class="text-sm font-extrabold text-gray-900">{{ $commande->numero_commande }}</p>
            </div>
            @if($commande->created_at)
            <p class="text-xs" style="color:#aaa;">
                {{ $commande->created_at->format('d/m/Y') }}
            </p>
            @endif
        </div>

        {{-- Milieu : badges + total --}}
        <div class="flex items-center justify-between px-5 py-4">
            <div class="flex flex-wrap gap-2">
                {{-- Statut commande --}}
                <span class="text-xs font-bold px-2.5 py-1 rounded-full"
                      style="background:{{ $sc['bg'] }}; color:{{ $sc['text'] }}; border:1.5px solid {{ $sc['border'] }};">
                    {{ $sc['icon'] }} {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                </span>
                {{-- Statut paiement --}}
                <span class="text-xs font-bold px-2.5 py-1 rounded-full"
                      style="background:{{ $pc['bg'] }}; color:{{ $pc['text'] }}; border:1.5px solid {{ $pc['border'] }};">
                    💳 {{ ucfirst($commande->payment_status) }}
                </span>
            </div>
            <p class="text-base font-extrabold" style="color:#E8184A;">
                {{ number_format($commande->total, 0, ',', ' ') }} FCFA
            </p>
        </div>

        {{-- Bas : bouton voir détails --}}
        <div class="px-5 pb-4">
            <a href="{{ route('commande.details', $commande->id) }}"
               class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl text-sm font-bold transition-all hover:opacity-90"
               style="background:#E8184A; color:#fff;">
                Voir les détails
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    @empty
    {{-- ─── Aucune commande ─── --}}
    <div class="rounded-2xl text-center py-20" style="background:#fff; border:1.5px solid #e8e8e8;">
        <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
             style="background:linear-gradient(135deg,#fff0f3,#fce4ec);">
            <svg class="w-8 h-8 opacity-40" fill="none" stroke="#E8184A" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
            </svg>
        </div>
        <p class="font-bold text-gray-700 text-base">Aucune commande pour l'instant</p>
        <p class="text-sm mt-1 mb-5" style="color:#aaa;">Vos commandes apparaîtront ici après votre premier achat.</p>
        <a href="{{ route('produits.index') }}"
           class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full text-sm font-bold"
           style="background:#E8184A; color:#fff;">
            Voir les produits
        </a>
    </div>
    @endforelse

    {{-- ─── Pagination ─── --}}
    @if($commandes->hasPages())
    <div class="flex justify-center gap-2 mt-6">
        @if($commandes->onFirstPage())
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold opacity-40 cursor-not-allowed"
                  style="background:#fff; border:1.5px solid #e8e8e8; color:#888;">‹</span>
        @else
            <a href="{{ $commandes->previousPageUrl() }}"
               class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold"
               style="background:#fff; border:1.5px solid #e8e8e8; color:#888;">‹</a>
        @endif

        @foreach($commandes->getUrlRange(1, $commandes->lastPage()) as $page => $url)
            @if($page == $commandes->currentPage())
                <span class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-bold"
                      style="background:#E8184A; border:1.5px solid #E8184A; color:#fff;">{{ $page }}</span>
            @else
                <a href="{{ $url }}"
                   class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold"
                   style="background:#fff; border:1.5px solid #e8e8e8; color:#888;">{{ $page }}</a>
            @endif
        @endforeach

        @if($commandes->hasMorePages())
            <a href="{{ $commandes->nextPageUrl() }}"
               class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold"
               style="background:#fff; border:1.5px solid #e8e8e8; color:#888;">›</a>
        @else
            <span class="w-9 h-9 flex items-center justify-center rounded-lg text-sm font-semibold opacity-40 cursor-not-allowed"
                  style="background:#fff; border:1.5px solid #e8e8e8; color:#888;">›</span>
        @endif
    </div>
    @endif

</div>
</div>

@endsection