@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<!-- Hero Section -->
<section 
    class="relative overflow-hidden min-h-[560px] flex items-center bg-gradient-to-br from-pink-100 via-yellow-50 to-primary-100 py-24 px-2 md:px-10"
    style="background-image: url('https://www.transparenttextures.com/patterns/diamond-upholstery.png');"
>
    <!-- Decorative Blobs -->
    <div class="absolute top-0 left-0 -z-10">
        <svg width="280" height="270" viewBox="0 0 280 270" fill="none" xmlns="http://www.w3.org/2000/svg" class="animate-blob-fast opacity-30">
            <ellipse cx="140" cy="135" rx="140" ry="135" fill="#fbbf24"/>
        </svg>
    </div>
    <div class="absolute bottom-0 right-0 -z-10">
        <svg width="220" height="210" viewBox="0 0 220 210" fill="none" xmlns="http://www.w3.org/2000/svg" class="animate-blob-fast opacity-20">
            <ellipse cx="110" cy="105" rx="100" ry="95" fill="#f472b6"/>
        </svg>
    </div>

    <div class="max-w-7xl mx-auto flex flex-col-reverse md:flex-row items-center justify-center md:justify-between w-full gap-20">
        <!-- Left text content -->
        <div class="flex-1 text-center md:text-left">
            <span class="inline-block mb-6 py-1 px-4 rounded-full bg-primary-100 text-primary-600 font-semibold shadow animate-infinite-tada text-sm uppercase tracking-widest">Livraison Express partout au Cameroun</span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6 bg-gradient-to-br from-pink-500 via-yellow-400 to-primary-700 text-transparent bg-clip-text drop-shadow-lg animate-fade-down">
                Bienvenue sur <span class="text-primary-500">ShopCM</span>
            </h1>
            <p class="text-lg md:text-xl mb-8 text-primary-800 animate-fade delay-150">
                Découvrez les meilleures offres et des <span class="font-semibold text-pink-500">produits de qualité</span> à prix exceptionnel.<br>
                <span class="inline-block mt-2 text-yellow-700 font-semibold">Satisfait ou remboursé !</span>
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start animate-fade-up">
                <a href="{{ route('produits.produit') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-8 py-4 rounded-full font-bold shadow-xl hover:scale-105 hover:shadow-2xl transition duration-150 flex items-center gap-2">
                    <i class="fas fa-shopping-bag"></i> Voir les produits
                </a>
                <a href="#promotions" class="border-2 border-primary-400 text-primary-700 bg-white px-8 py-4 rounded-full font-bold hover:bg-primary-50 hover:text-primary-700 hover:border-pink-400 transition shadow flex items-center gap-2">
                    <i class="fas fa-tags"></i> Promotions
                </a>
            </div>
        </div>
        <!-- Right Image with blobs -->
        <div class="flex-1 flex items-center justify-center relative animate-fade">
            <span class="absolute -top-6 -right-4 w-24 h-24 rounded-full bg-yellow-100 animate-infinite-bounce blur-xl opacity-60"></span>
            <span class="absolute -bottom-10 -left-8 w-28 h-16 bg-pink-100 rounded-full blur-2xl opacity-50"></span>
            <div class="relative z-10">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=520&auto=format&fit=crop&q=80&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D" 
                     alt="Shopping" 
                     class="max-w-xs sm:max-w-sm lg:max-w-md rounded-3xl shadow-2xl border-4 border-white" />
                <!-- Floating Offer Card -->
                <div class="absolute -bottom-6 -right-8 bg-white rounded-xl shadow-2xl px-6 py-4 flex items-center gap-3 animate-infinite-tada border-2 border-pink-200">
                    <i class="fas fa-bolt text-yellow-400 text-2xl animate-pulse"></i>
                    <span>
                        <span class="block font-bold text-primary-700">-20% cette semaine</span>
                        <span class="block text-xs text-pink-500">Sur une sélection produits</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

 
<!-- <section 
    class="relative bg-cover bg-center bg-no-repeat py-20" 
    style="background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1200&auto=format&fit=crop&q=80&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D');"
>
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative max-w-4xl mx-auto px-4 text-center text-white z-10">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 drop-shadow-lg">
            Bienvenue sur <span class="text-primary-400">ShopCM</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8">
            Découvrez notre sélection de produits de qualité avec livraison rapide partout au Cameroun
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            {{-- <a href="{{ route('produits.index') }}" class="bg-primary-500 hover:bg-primary-600 text-white px-8 py-4 rounded-lg font-bold shadow-lg transition"> --}}
                Voir les produits
            </a>
            <a href="#promotions" class="border-2 border-white text-white px-8 py-4 rounded-lg font-bold hover:bg-white hover:text-primary-600 transition shadow-lg">
                Promotions
            </a>
        </div>
    </div>
</section>
<!<section class="bg-gradient-to-r from-primary-600 to-primary-800 text-white py-20 bg-url" >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-5xl font-bold mb-6">
                    Bienvenue sur <span class="text-white">ShopCM</span>
                </h1>
                <p class="text-xl mb-8 text-primary-100">
                    Découvrez notre sélection de produits de qualité avec livraison rapide partout au Cameroun
                </p>
                <div class="flex space-x-4">
                    {{-- <a href="{{ route('produits.index') }}" class="bg-white text-primary-600 px-8 py-3 rounded-lg font-bold hover:bg-gray-100 transition"> --}}
                        Voir les produits
                    </a>
                    <a href="#promotions" class="border-2 border-white text-white px-8 py-3 rounded-lg font-bold hover:bg-white hover:text-primary-600 transition">
                        Promotions
                    </a>
                </div>
                
            </div>
            <div class="hidden md:block">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2hvZXN8ZW58MHx8MHx8fDA%3D" alt="Shopping" class="rounded-lg shadow-2xl">
            </div>
        </div>
    </div>
</section> -->

<!-- Catégories -->
<!-- Catégories améliorées -->
<section class="py-16 bg-gradient-to-br from-primary-50 via-primary-100 to-white relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-12 text-center">
            <span class="inline-block border-b-4 border-primary-500 pb-2">Nos Catégories</span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @forelse($categories as $categorie)
            <a 
                href="{{ route('produits.categorie', $categorie->id) }}" 
                class="
                    bg-white/70 backdrop-blur-xl rounded-2xl shadow-lg hover:shadow-2xl transition 
                    p-6 text-center group transform hover:scale-105 duration-200 relative border-2 border-transparent hover:border-primary-500
                    focus:ring-2 focus:ring-primary-300 focus:outline-none
                "
                tabindex="0"
            >
                <div class="relative w-24 h-24 mx-auto mb-6 flex items-center justify-center
                    rounded-full border-4 border-primary-100 group-hover:border-primary-400 transition-shadow shadow-lg 
                    bg-gradient-to-tr from-primary-100 via-white to-primary-50 overflow-hidden">
                    @if($categorie->image)
                        <img src="{{Storage::url($categorie->image)}}" alt="{{ $categorie->nom }}" class="object-cover w-full h-full rounded-full group-hover:scale-110 transition">
                    @else
                        <i class="fas fa-cube text-4xl text-primary-500 group-hover:text-primary-700"></i>
                    @endif
                    <span class="absolute top-1 right-1 flex items-center justify-center w-6 h-6 bg-primary-500 text-white text-xs font-bold rounded-full shadow-lg">
                        {{ $categorie->produits_count }}
                    </span>
                </div>
                <h3 class="font-extrabold text-lg mb-2 text-primary-700 group-hover:text-primary-900 transition">{{ $categorie->nom }}</h3>
                <p class="text-sm text-gray-600 mb-4">{{ $categorie->produits_count }} produit{{ $categorie->produits_count > 1 ? 's' : '' }}</p>
                {{-- <button
                    class="mt-2 inline-block px-6 py-2 rounded-full text-primary-700 border border-primary-300 bg-primary-50 hover:bg-primary-500 hover:text-white font-semibold shadow transition"
                    aria-label="Découvrir les produits de {{ $categorie->nom }}">
                    Découvrir
                </button> --}}
                <span 
                    class="absolute inset-0 rounded-2xl border-4 border-primary-300 opacity-0 group-hover:opacity-20 pointer-events-none transition"></span>
            </a>
            @empty
            <div class="col-span-full text-center text-gray-600">
                Aucune catégorie disponible
            </div>
            @endforelse
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Animation d'effet au focus clavier sur les cartes catégorie (accessibilité)
    document.querySelectorAll('[tabindex="0"]').forEach(function(catCard) {
        catCard.addEventListener('focus', function() {
            this.classList.add('ring', 'ring-primary-300');
        });
        catCard.addEventListener('blur', function() {
            this.classList.remove('ring', 'ring-primary-300');
        });
    });
});
</script>
<!-- Fin Catégories améliorées -->

<!-- Section "Produits en vedette" améliorée et designée -->
<section class="py-20 bg-gradient-to-br from-primary-50 via-white to-primary-200 relative overflow-hidden">
    <!-- Effets lumineux décoratifs -->
    <div class="absolute -top-28 -left-32 w-96 h-96 bg-primary-200 opacity-40 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 right-0 w-96 h-96 bg-pink-200 opacity-30 rounded-full blur-3xl pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-12 gap-6">
            <h2 class="text-4xl md:text-5xl font-black text-primary-700 tracking-tight flex items-center gap-3 leading-snug drop-shadow-md">
                <span>
                    <i class="fas fa-star text-yellow-400 animate-pulse mr-2"></i>
                    Produits en vedette
                </span>
                <span class="bg-gradient-to-r from-primary-400 via-pink-400 to-yellow-300 px-3 py-0.5 rounded-full text-white text-lg font-bold animate-gradient-x shadow-lg hidden md:inline-block">Sélection du moment</span>
            </h2>
            <a href="{{ route('produits.produit') }}" class="inline-flex items-center gap-1 px-7 py-3 rounded-full font-bold shadow-lg bg-primary-100 text-primary-800 hover:bg-primary-400 hover:text-white transition border-2 border-primary-200 hover:scale-105 duration-200">
                Voir tout <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($produitsVedette as $produit)
            <div class="relative flex flex-col rounded-3xl shadow-xl overflow-hidden bg-white group hover:-translate-y-1 hover:shadow-2xl transition-all duration-300">
                <!-- Ruban promotionnel s'il y a -->
                @if($produit->en_promotion)
                    <span class="absolute left-0 top-4 z-10 bg-gradient-to-r from-red-600 to-pink-500 text-white px-4 py-1.5 rounded-tr-xl rounded-br-xl font-semibold text-xs uppercase animate-bounce shadow-md">
                        Promo
                    </span>
                @endif

                <!-- Image du produit avec overlay d'effet -->
                <div class="relative h-60 flex items-center justify-center bg-gradient-to-t from-primary-50 to-white group-hover:scale-105 transition-transform duration-300">
                    <img src="{{Storage::url($produit->image_principale)}}" alt="{{ $produit->nom }}"
                        class="object-contain w-full h-full transition-transform duration-500 group-hover:scale-110 drop-shadow-xl">
                    <!-- overlay pour hover -->
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-all"></div>
                    <div class="absolute bottom-3 right-3">
                        <a href="{{ route('produits.show', $produit->id) }}" 
                            class="opacity-0 group-hover:opacity-100 translate-y-3 group-hover:translate-y-0 transition-all duration-300 bg-primary-600 text-white px-6 py-2 rounded-full font-bold shadow-xl text-sm hover:scale-105 hover:bg-pink-600 flex items-center gap-2">
                            <i class="fas fa-eye"></i> Voir détails
                        </a>
                    </div>
                </div>
                <!-- Infos produit -->
                <div class="flex-1 flex flex-col justify-between p-6">
                    <div class="mb-3">
                        <h3 class="font-extrabold text-lg md:text-xl text-primary-800 truncate mb-1 group-hover:text-primary-600 transition">
                            {{ $produit->nom }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-4 min-h-[44px] line-clamp-2">{{ $produit->description }}</p>
                    </div>
                    <div class="flex justify-between items-end mt-auto">
                        <div class="flex flex-col">
                            @if($produit->en_promotion && $produit->prix_promo)
                                <span class="text-gray-400 font-semibold line-through text-base mb-0.5">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</span>
                                <span class="text-primary-600 font-bold text-xl animate-pulse">{{ number_format($produit->prix_promo, 0, ',', ' ') }} FCFA</span>
                            @else
                                <span class="text-primary-600 font-bold text-xl">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</span>
                            @endif
                        </div>
                        <button onclick="ajouterAuPanier({{ $produit->id }})" 
                                class="bg-primary-600 text-white p-3 rounded-xl shadow-lg hover:bg-primary-700 hover:scale-110 transition flex items-center justify-center"
                                aria-label="Ajouter {{ $produit->nom }} au panier"
                                onmouseover="this.querySelector('.cart-bounce').classList.add('animate-bounce')" 
                                onmouseout="this.querySelector('.cart-bounce').classList.remove('animate-bounce')"
                        >
                            <i class="fas fa-shopping-cart cart-bounce"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination si besoin -->
        @if(method_exists($produitsVedette, 'links'))
            <div class="mt-10 flex justify-center">
                {{ $produitsVedette->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</section>
<!-- Fin produits en vedette améliorée -->




<!-- Promotions -->
<section id="promotions" class="relative py-20 bg-gradient-to-br from-pink-50 via-yellow-50 to-white overflow-hidden z-20">
    <!-- Decorative Background Blobs -->
    <div class="pointer-events-none absolute -top-24 -left-16 w-80 h-80 bg-red-500/10 rounded-full blur-3xl animate-blob z-0"></div>
    <div class="pointer-events-none absolute top-2/3 right-4 w-72 h-72 bg-yellow-400/20 rounded-full blur-2xl animate-blob animation-delay-2000 z-0"></div>
    <div class="pointer-events-none absolute bottom-6 left-1/2 -translate-x-1/2 w-96 h-32 bg-pink-200/30 rounded-full blur-xl z-0"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-extrabold text-center text-red-600 drop-shadow mb-4 flex justify-center items-center gap-3">
            <span class="inline-flex items-center justify-center bg-yellow-200/90 rounded-full p-3 mr-2 shadow animate-bounce"><i class="fas fa-fire text-red-500 text-2xl"></i></span>
            Promotions du moment
        </h2>
        <p class="text-center text-lg text-gray-700 mb-10 max-w-2xl mx-auto">
            Profitez de <span class="font-bold text-red-500">prix cassés</span> sur une sélection exceptionnelle de produits !
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
            @forelse($produitsPromo as $produit)
            <div 
                class="relative bg-white rounded-3xl shadow-lg hover:shadow-2xl border-2 border-red-200 group transition transform hover:-translate-y-2 hover:scale-[1.015] duration-300 overflow-hidden"
            >
                <!-- Image & promo badge -->
                <div class="relative overflow-hidden">
                    <img src="{{Storage::url($produit->image_principale)}}" alt="{{ $produit->nom }}" 
                        class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-105">
                    @php
                        $reduction = round((($produit->prix - $produit->prix_promo) / $produit->prix) * 100);
                    @endphp
                    <span
                        class="absolute top-4 left-4 z-[2] bg-gradient-to-tr from-red-600 via-pink-500 to-yellow-400 text-white drop-shadow font-black px-4 py-1.5 rounded-full text-sm shadow-lg animate-pulse border-2 border-white"
                    >
                        <i class="fas fa-bolt mr-1"></i> -{{ $reduction }}%
                    </span>
                    <!-- Floating bubbles overlay effect -->
                    <span class="absolute bottom-4 right-4 w-8 h-8 bg-yellow-200/70 blur-lg rounded-full animate-ping"></span>
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col justify-end items-center p-5"
                    >
                        <a href="{{ route('produits.show', $produit->id) }}" 
                            class="w-full block bg-white text-primary-600 font-extrabold text-center px-6 py-2.5 rounded-xl shadow-lg hover:bg-primary-600 hover:text-white transition duration-200 border border-primary-200">
                            Voir détails
                        </a>
                        <span class="mt-2 inline-flex px-3 py-1 rounded-full text-sm font-semibold text-yellow-600 bg-yellow-100/90 animate-bounce">
                            <i class="fas fa-gift mr-1"></i> Offre limitée !
                        </span>
                    </div>
                </div>
                <!-- Content -->
                <div class="p-5 pb-4 flex flex-col h-[168px]">
                    <h3 class="font-bold text-lg text-gray-900 mb-1 truncate">{{ $produit->nom }}</h3>
                    <p class="text-gray-600 text-sm mb-4 grow line-clamp-2">{{ $produit->description }}</p>
                    <div class="flex items-end justify-between">
                        <div>
                            <div class="text-gray-400 line-through text-xs">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</div>
                            <div class="text-red-600 font-extrabold text-xl drop-shadow">{{ number_format($produit->prix_promo, 0, ',', ' ') }} FCFA</div>
                        </div>
                        @auth
                        <button onclick="ajouterAuPanier({{ $produit->id }})" 
                                class="bg-primary-600 text-white p-3 rounded-xl shadow-lg hover:bg-primary-700 hover:scale-110 transition flex items-center justify-center"
                                aria-label="Ajouter {{ $produit->nom }} au panier"
                                onmouseover="this.querySelector('.cart-bounce').classList.add('animate-bounce')" 
                                onmouseout="this.querySelector('.cart-bounce').classList.remove('animate-bounce')"
                        >
                            <i class="fas fa-shopping-cart cart-bounce"></i>
                        </button>
                        @else
                        <a href="{{ route('login') }}" 
                           class="bg-primary-600 text-white p-3 rounded-xl shadow-lg hover:bg-primary-700 hover:scale-110 transition flex items-center justify-center"
                           aria-label="Connectez-vous pour acheter"
                        >
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                        @endauth
                    </div>
                </div>
                <span class="absolute top-0 right-0 w-12 h-12 bg-yellow-300/30 blur-xl z-0"></span>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500 py-12">
                Aucune promotion en cours actuellement. Revenez bientôt !
            </div>
            @endforelse
        </div>
        <div class="mt-12 flex justify-center">
            <a href="{{ route('produits.index', ['promo' => 1]) }}" class="inline-flex items-center gap-2 px-8 py-3 bg-red-600 text-white rounded-full font-bold text-lg shadow-lg hover:bg-red-700 transition group">
                <span>Voir toutes les produits disponible</span>
                <i class="fas fa-arrow-right-long group-hover:translate-x-1 transition"></i>
            </a>
        </div>
    </div>
    <script>
        // Animation légère d'invitation sur le bouton "Voir tout"
        document.addEventListener("DOMContentLoaded", () => {
            let promoBtn = document.querySelector("#promotions .mt-12 a");
            if(promoBtn) {
                setTimeout(() => {
                    promoBtn.classList.add("ring", "ring-red-200", "ring-offset-2");
                    setTimeout(() => {
                        promoBtn.classList.remove("ring", "ring-red-200", "ring-offset-2");
                    }, 1600);
                }, 1000);
            }
        });
    </script>
</section>
<!-- Section Avantages améliorée -->
<section class="py-24 bg-gradient-to-br from-yellow-200 via-pink-50 to-primary-100 relative overflow-hidden" id="avantages">
    <!-- Blobs décoratifs/fond -->
    <div class="absolute top-0 -left-36 w-[420px] h-[420px] bg-pink-400/25 rounded-full blur-3xl opacity-70 animate-blob-fast -z-10"></div>
    <div class="absolute bottom-0 -right-28 w-[540px] h-[540px] bg-primary-400/20 rounded-full blur-3xl opacity-50 animate-blob -z-10"></div>
    <div class="absolute left-1/2 top-1/3 w-[260px] h-[160px] bg-yellow-100/70 rounded-full blur-2xl opacity-70 rotate-[30deg] -z-10"></div>
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 relative z-10">
        <div class="flex flex-col items-center gap-3 mb-2 animate-fade-down">
            <span class="inline-flex items-center text-4xl md:text-5xl text-yellow-400 animate-wiggle">
                <i class="fas fa-sparkles"></i>
            </span>
            <h2 class="text-3xl md:text-5xl font-extrabold text-center leading-tight text-transparent bg-clip-text bg-gradient-to-r from-primary-700 via-pink-600 to-yellow-600 drop-shadow-[0_2px_4px_rgba(247,179,17,0.1)] tracking-tight">
                Pourquoi <span class="underline decoration-4 decoration-pink-400 underline-offset-8">nous choisir</span>&nbsp;?
            </h2>
        </div>
        <p class="text-center text-lg md:text-xl text-primary-700 mb-14 mx-auto max-w-2xl animate-fade">
            Découvrez les <span class="font-semibold text-pink-600">atouts uniques</span> qui font de notre boutique votre partenaire idéal pour tous vos achats au Cameroun.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 lg:gap-16 animate-fade-up">

            <!-- Livraison Express -->
            <div class="bg-white shadow-xl rounded-3xl relative overflow-hidden group transition-transform hover:-translate-y-4 hover:shadow-2xl animate-infinite-tada border-t-4 border-pink-400 hover:border-yellow-400 duration-300 p-1">
                <div class="absolute -top-10 left-2 right-2 h-20 bg-gradient-to-r from-pink-300/20 via-yellow-200/40 to-primary-100/30 rounded-full blur-3xl opacity-60 z-0"></div>
                <div class="relative flex flex-col items-center text-center gap-2 z-10 p-9 pt-10">
                    <span class="flex items-center justify-center bg-gradient-to-tr from-yellow-300 to-pink-200 text-primary-800 rounded-full shadow-lg w-20 h-20 mb-5 text-4xl border-4 border-white group-hover:ring-4 group-hover:ring-pink-200 transition-all">
                        <i class="fas fa-shipping-fast animate-wiggle"></i>
                    </span>
                    <h3 class="text-2xl font-bold mb-2 bg-gradient-to-r from-pink-700 via-primary-700 to-yellow-700 text-transparent bg-clip-text">Livraison Express</h3>
                    <p class="text-gray-700 mb-2">
                        <span class="font-semibold text-primary-600">Recevez vos commandes</span> partout au Cameroun en un temps record, souvent sous <b class="bg-yellow-200 px-2 py-0.5 rounded underline decoration-wavy decoration-pink-400">48h</b> chrono.
                    </p>
                    <span class="text-xs font-bold text-pink-500 tracking-widest uppercase">
                        Suivi dynamique en temps réel
                        <i class="fas fa-location-arrow ml-1 animate-bounce"></i>
                    </span>
                </div>
            </div>
            <!-- Paiement Sécurisé -->
            <div class="bg-white shadow-xl rounded-3xl relative overflow-hidden group transition-transform hover:-translate-y-4 hover:shadow-2xl animate-infinite-heartbeat border-t-4 border-yellow-400 hover:border-primary-500 duration-300 p-1 delay-100">
                <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-yellow-400/20 rounded-full blur-2xl z-0"></div>
                <div class="relative flex flex-col items-center text-center gap-2 z-10 p-9 pt-10">
                    <span class="flex items-center justify-center bg-gradient-to-bl from-yellow-200 via-yellow-500/30 to-primary-100 text-yellow-800 rounded-full shadow-lg w-20 h-20 mb-5 text-4xl border-4 border-white group-hover:ring-4 group-hover:ring-yellow-200 transition-all">
                        <i class="fas fa-lock animate-pulse"></i>
                    </span>
                    <h3 class="text-2xl font-bold mb-2 bg-gradient-to-r from-yellow-700 via-pink-700 to-primary-700 text-transparent bg-clip-text">Paiement Sécurisé</h3>
                    <p class="text-gray-700 mb-2">
                        Des <span class="font-semibold text-yellow-700">transactions chiffrées et fiables</span>. <br>
                        <span class="italic">Optez pour le paiement à la livraison si vous préférez !</span>
                    </p>
                    <span class="text-xs font-bold text-primary-500 tracking-widest uppercase">
                        CB | Mobile Money | Espèces
                        <i class="fas fa-credit-card ml-1 animate-wiggle"></i>
                    </span>
                </div>
            </div>
            <!-- Service Client Premium -->
            <div class="bg-white shadow-xl rounded-3xl relative overflow-hidden group transition-transform hover:-translate-y-4 hover:shadow-2xl animate-infinite-bounce border-t-4 border-primary-400 hover:border-pink-400 duration-300 p-1 delay-150">
                <div class="absolute bottom-0 right-0 w-36 h-16 bg-primary-200/50 rounded-br-3xl blur-lg z-0"></div>
                <div class="relative flex flex-col items-center text-center gap-2 z-10 p-9 pt-10">
                    <span class="flex items-center justify-center bg-gradient-to-tr from-pink-200 to-yellow-100 text-pink-600 rounded-full shadow-lg w-20 h-20 mb-5 text-4xl border-4 border-white group-hover:ring-4 group-hover:ring-primary-200 transition-all">
                        <i class="fas fa-headset animate-shake"></i>
                    </span>
                    <h3 class="text-2xl font-bold mb-2 bg-gradient-to-r from-pink-700 via-primary-700 to-yellow-600 text-transparent bg-clip-text">Service Client Premium</h3>
                    <p class="text-gray-700 mb-2">
                        Assistance <span class="font-semibold text-pink-600">7j/7</span>, conseils personnalisés avant/après achat et un <span class="underline decoration-wavy decoration-pink-400">suivi exceptionnel</span>.
                    </p>
                    <span class="text-xs font-bold text-yellow-600 tracking-widest uppercase">
                        Toujours à l’écoute&nbsp;<i class="fas fa-heart animate-pulse text-pink-400 ml-1"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="mt-14 flex flex-col items-center gap-2">
            <a href="#produits" class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-pink-500 to-yellow-400 text-white text-base md:text-lg rounded-full font-extrabold shadow-xl hover:scale-105 hover:shadow-2xl transition duration-200 animate-wiggle cursor-pointer">
                Découvrir tous nos produits
                <i class="fas fa-arrow-down-long animate-bounce ml-2"></i>
            </a>
            <span class="mt-2 text-sm text-pink-600 font-medium animate-fade">
                Passez commande vite, des surprises vous attendent !
            </span>
        </div>
    </div>
    <style>
        @keyframes wiggle {
            0%, 100% { transform: rotate(-8deg);}
            50% { transform: rotate(8deg);}
        }
        .animate-wiggle {
            animation: wiggle 1.1s infinite ease-in-out;
        }
        @keyframes infinite-tada {
            0%   { transform: scale(1);}
            10%  { transform: scale(0.95) rotate(-3deg);}
            20%  { transform: scale(1.05) rotate(3deg);}
            30%  { transform: scale(0.92) rotate(-2deg);}
            40%,100% { transform: scale(1) rotate(0);}
        }
        .animate-infinite-tada { animation: infinite-tada 2s infinite; }
        @keyframes infinite-bounce {
            0%,100% { transform: scale(1);}
            20%     { transform: scale(1.05) translateY(-6px);}
            50%     { transform: scale(0.98) translateY(2px);}
            80%     { transform: scale(1.07);}
        }
        .animate-infinite-bounce { animation: infinite-bounce 2.1s infinite;}
        @keyframes infinite-heartbeat {
            0%, 100% { transform: scale(1);}
            14% { transform: scale(1.08);}
            28% { transform: scale(0.98);}
            42% { transform: scale(1.06);}
            70% { transform: scale(1);}
        }
        .animate-infinite-heartbeat { animation: infinite-heartbeat 2.5s infinite; }
        @keyframes fade-down {
            0% {
                transform: translateY(-30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .animate-fade-down { animation: fade-down 1.1s cubic-bezier(.16,1,.3,1) both;}
        @keyframes fade-up {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .animate-fade-up { animation: fade-up 1.4s .4s cubic-bezier(.16,1,.3,1) both;}
        @keyframes fade {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .animate-fade { animation: fade 1s both;}
        /* blob speed for decor */
        @keyframes blob-fast {
            0%,100% { transform: scale(1) translateY(0);}
            33%  { transform: scale(1.07, 0.92) translateY(-14px);}
            66%  { transform: scale(0.95,1.05) translateY(20px);}
        }
        .animate-blob-fast { animation: blob-fast 12s infinite ease-in-out;}
    </style>
</section>



@endsection

@push('scripts')
<script>
function ajouterAuPanier(produitId) {
    fetch('{{ route("panier.ajouter") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            produit_id: produitId,
            quantite: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mettre à jour le compteur du panier
            document.getElementById('panier-count').textContent = data.count;
            
            // Afficher une notification
            alert('Produit ajouté au panier !');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue');
    });
}
</script>
@endpush
