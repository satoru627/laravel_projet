@extends('layouts.app')

@section('title', 'Commande admin')

@section('content')

<div style="background:#F5F5F5; font-family:'Poppins',sans-serif; min-height:100vh; padding:24px 16px 60px;">
<div class="max-w-3xl mx-auto">

    {{-- ─── Header ─── --}}
    <div class="mb-6">
        <a href="{{ route('admin.commandes.index') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold mb-4"
           style="color:#E8184A;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Toutes les commandes
        </a>
        <h1 class="text-2xl font-extrabold text-gray-900">
            Commande <span style="color:#E8184A;">{{ $commande->numero_commande }}</span>
        </h1>
    </div>

    {{-- ─── Infos client ─── --}}
    <div class="rounded-2xl overflow-hidden mb-4"
         style="background:#fff; border:1.5px solid #e8e8e8;">

        <div class="px-5 py-4" style="border-bottom:1.5px solid #f0f0f0;">
            <h2 class="font-bold text-gray-900 text-base">Informations client</h2>
        </div>

        <div class="px-5 py-4 grid grid-cols-1 sm:grid-cols-2 gap-4">

            {{-- Client --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,#fff0f3,#fce4ec);">
                    <svg class="w-5 h-5 opacity-60" fill="none" stroke="#E8184A" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs" style="color:#aaa;">Client</p>
                    <p class="text-sm font-bold text-gray-900">
                        {{ $commande->user->nom }} {{ $commande->user->prenom }}
                    </p>
                </div>
            </div>

            {{-- Téléphone --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,#fff0f3,#fce4ec);">
                    <svg class="w-5 h-5 opacity-60" fill="none" stroke="#E8184A" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs" style="color:#aaa;">Téléphone livraison</p>
                    <p class="text-sm font-bold text-gray-900">{{ $commande->telephone_livraison }}</p>
                </div>
            </div>

            {{-- Ville --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,#fff0f3,#fce4ec);">
                    <svg class="w-5 h-5 opacity-60" fill="none" stroke="#E8184A" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs" style="color:#aaa;">Ville de livraison</p>
                    <p class="text-sm font-bold text-gray-900">{{ $commande->ville_livraison }}</p>
                </div>
            </div>

            {{-- Statut actuel --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,#fff0f3,#fce4ec);">
                    <svg class="w-5 h-5 opacity-60" fill="none" stroke="#E8184A" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs" style="color:#aaa;">Statut actuel</p>
                    <p class="text-sm font-bold" style="color:#E8184A;">
                        {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Notes --}}
        @if($commande->notes)
        <div class="mx-5 mb-4 p-4 rounded-xl" style="background:#FFF7ED; border:1px solid #FED7AA;">
            <p class="text-xs font-bold mb-1" style="color:#C2410C;">📝 Notes</p>
            <p class="text-sm" style="color:#92400E;">{{ $commande->notes }}</p>
        </div>
        @endif
    </div>

    {{-- ─── Mise à jour statut ─── --}}
    <div class="rounded-2xl overflow-hidden mb-4"
         style="background:#fff; border:1.5px solid #e8e8e8;">

        <div class="px-5 py-4" style="border-bottom:1.5px solid #f0f0f0;">
            <h2 class="font-bold text-gray-900 text-base">Mettre à jour le statut</h2>
        </div>

        <form method="POST" action="{{ route('admin.commandes.statut', $commande->id) }}"
              class="px-5 py-4 flex flex-col sm:flex-row gap-3">
            @csrf
            <select name="statut"
                    class="flex-1 rounded-xl text-sm font-semibold px-4 py-3 outline-none"
                    style="border:1.5px solid #e8e8e8; background:#fafafa; color:#333;">
                @foreach(['en_attente','confirmee','en_preparation','expediee','livree','annulee','failed'] as $st)
                    <option value="{{ $st }}" @selected($commande->statut === $st)>
                        {{ ucfirst(str_replace('_', ' ', $st)) }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    class="flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-bold transition-all hover:opacity-90"
                    style="background:#E8184A; color:#fff;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Mettre à jour
            </button>
        </form>
    </div>

    {{-- ─── Articles commandés ─── --}}
    <div class="rounded-2xl overflow-hidden"
         style="background:#fff; border:1.5px solid #e8e8e8;">

        <div class="px-5 py-4" style="border-bottom:1.5px solid #f0f0f0;">
            <h2 class="font-bold text-gray-900 text-base">Articles commandés</h2>
        </div>

        @foreach($commande->details as $detail)
        <div class="flex items-center justify-between px-5 py-4"
             style="border-bottom:1px solid #f5f5f5;">

            <div class="flex items-center gap-3">
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
                    <p class="text-sm font-semibold text-gray-900">
                        {{ $detail->produit->nom ?? 'Produit supprimé' }}
                    </p>
                    <p class="text-xs" style="color:#aaa;">Qté : {{ $detail->quantite }}</p>
                </div>
            </div>

            <p class="text-sm font-bold" style="color:#E8184A;">
                {{ number_format($detail->sous_total, 0, ',', ' ') }} FCFA
            </p>
        </div>
        @endforeach

    </div>

</div>
</div>

@endsection