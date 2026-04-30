

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title', 'Produits — ShopCM')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  .shopcm-page { font-family: 'Poppins', sans-serif; }
  .scrollbar-hide::-webkit-scrollbar { display: none; }
  .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
  .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

  /* Carte produit */
  .product-card {
    background: #fff;
    border: 1.5px solid #e8e8e8;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: box-shadow .25s, transform .25s;
  }
  .product-card:hover {
    box-shadow: 0 8px 24px rgba(232, 24, 74, 0.13);
    transform: translateY(-3px);
  }

  /* Carte featured */
  .featured-card {
    background: #fff;
    border: 1.5px solid #e8e8e8;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    box-shadow: 0 2px 16px rgba(232, 24, 74, 0.08);
  }

  /* Bouton principal */
  .btn-pink {
    background: #E8184A;
    color: #fff;
    border-radius: 100px;
    font-weight: 700;
    transition: background .2s, transform .2s;
  }
  .btn-pink:hover { background: #c4153f; transform: scale(1.02); }

  /* Bouton panier carré */
  .btn-cart {
    width: 30px; height: 30px;
    background: #E8184A;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: background .2s, transform .2s;
  }
  .btn-cart:hover { background: #c4153f; transform: scale(1.08); }

  /* Chip filtre */
  .filter-chip {
    flex-shrink: 0;
    padding: 6px 16px;
    border-radius: 100px;
    font-size: 12px; font-weight: 600;
    border: 1.5px solid #e8e8e8;
    background: #fff;
    color: #888;
    cursor: pointer;
    transition: all .2s;
    white-space: nowrap;
  }
  .filter-chip.active,
  .filter-chip:hover {
    background: #E8184A;
    border-color: #E8184A;
    color: #fff;
  }

  /* Pagination */
  .pg-btn {
    width: 34px; height: 34px;
    border-radius: 8px;
    border: 1.5px solid #e8e8e8;
    background: #fff;
    color: #888;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; font-weight: 600;
    transition: all .2s;
  }
  .pg-btn.active, .pg-btn:hover {
    background: #E8184A;
    border-color: #E8184A;
    color: #fff;
  }
  .pg-btn:hover { text-decoration: none; }
</style>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Configuration Tailwind personnalisée -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fff1f2',
                            100: '#ffe4e6',
                            200: '#fecdd3',
                            300: '#fda4af',
                            400: '#fb7185',
                            500: '#f43f5e',
                            600: '#e11d48',
                            700: '#be123c',
                            800: '#9f1239',
                            900: '#871337',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    
    <!-- Barre de navigation dynamique et interactive -->
    <nav class="bg-white shadow-lg sticky top-0 z-50 transition-all duration-300" x-data="{ mobileOpen: false, profileOpen: false }" @scroll.window="window.scrollY > 50 ? $el.classList.add('shadow-lg','bg-primary-50') : $el.classList.remove('shadow-lg','bg-primary-50')">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo animé -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-primary-800 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition-transform duration-200 shadow-inner">
                            <i class="fas fa-shopping-bag text-white text-xl animate-bounce group-hover:animate-none"></i>
                        </div>
                        <span class="text-1xl font-bold text-gray-900 group-hover:text-primary-600 transition">
                            Shop<span class="text-primary-600">CM</span>
                        </span>
                    </a>
                </div>
                <!-- Menu principal -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 font-medium transition relative after:block after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-primary-600 after:transition-all after:duration-300">
                        Accueil
                    </a>
                    <a href="{{ route('produits.produit') }}" class="text-gray-700 hover:text-primary-600 font-medium transition relative after:block after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-primary-600 after:transition-all after:duration-300">
                       tous les Produits
                    </a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">
                                <i class="fas fa-chart-line mr-1"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('commande.liste') }}" class="text-gray-700 hover:text-primary-600 font-medium transition">
                                Mes commandes
                            </a>
                        @endif
                    @endauth
                </div>
                <!-- Actions utilisateur -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- Panier animé -->
                        <a href="{{ route('panier.index') }}" class="relative text-gray-700 hover:text-primary-600 transition group">
                            <i class="fas fa-shopping-cart text-xl group-hover:scale-110 transition-transform"></i>
                            <span id="panier-count" class="absolute -top-2 -right-2 bg-primary-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center font-bold ring-2 ring-white group-hover:animate-pulse">
                                {{ session('panier') ? count(session('panier')) : 0 }}
                            </span>
                        </a>
                        <!-- Menu utilisateur interactif -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @keydown.escape="open = false" class="flex items-center space-x-2 text-gray-700 hover:text-primary-600 transition focus:outline-none focus:ring-2 focus:ring-primary-600 rounded px-2">
                                <i class="fas fa-user-circle text-2xl"></i>
                                <span class="hidden md:block font-medium">{{ auth()->user()->prenom }}</span>
                                <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': open}"></i>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-52 bg-white rounded-lg shadow-lg py-2 border border-gray-100 ring-1 ring-black ring-opacity-5 z-50 origin-top-right"
                                x-transition:enter="transition ease-out duration-150" 
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-100"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95">
                                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 transition rounded flex items-center">
                                    <i class="fas fa-user mr-2"></i> Mon profil
                                </a>
                                @if(auth()->user()->role === 'client')
                                    <a href="{{ route('commande.liste') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 transition rounded flex items-center">
                                        <i class="fas fa-box mr-2"></i> Mes commandes
                                    </a>
                                @endif
                                <hr class="my-2 border-gray-200">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100 transition rounded flex items-center">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600 font-medium transition flex items-center space-x-1 px-2 py-1 rounded hover:bg-primary-50">
                            <i class="fas fa-sign-in-alt mr-1"></i> <span>Connexion</span>
                        </a>
                        <a href="{{ route('register') }}" class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition font-medium flex items-center space-x-1 shadow hover:shadow-lg">
                            <i class="fas fa-user-plus mr-1"></i> <span>S'inscrire</span>
                        </a>
                    @endauth
                    <!-- Bouton Menu mobile -->
                    <button class="md:hidden text-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-600 rounded p-2 hover:bg-gray-100 transition" @click="mobileOpen = !mobileOpen" aria-label="Menu">
                        <i class="fas fa-bars text-xl transition-transform" :class="{'scale-125': mobileOpen}"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Menu mobile animé -->
        <div x-show="mobileOpen"
            @click.away="mobileOpen = false"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            id="mobile-menu" class="md:hidden bg-white border-t border-gray-100 py-4 shadow-lg z-40">
            <div class="px-4 space-y-3">
                <a href="{{ route('home') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition">
                    Accueil
                </a>
                <a href="{{ route('produits.produit') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition">
                   tous les Produits
                </a>
                @auth
                    @if(auth()->user()->role !== 'admin')
                        <a href="{{ route('commande.liste') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition">
                            Mes commandes
                        </a>
                    @endif
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition">
                        S'inscrire
                    </a>
                @endguest
            </div>
        </div>
    </nav>
    
    <!-- Messages flash dynamiques -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4 transition-opacity duration-500" x-data="{show: true}" x-show="show">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between shadow">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="ml-4 text-green-600 hover:text-green-800 bg-green-100 hover:bg-green-200 rounded p-1 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4 transition-opacity duration-500" x-data="{show: true}" x-show="show">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center justify-between shadow">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="ml-4 text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 rounded p-1 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif






{{-- Police Poppins si pas déjà dans le layout --}}


<div class="shopcm-page min-h-screen py-6 pb-16" style="background:#F5F5F5;">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- ─── Header ─────────────────────────────────────────── --}}
    <div class="mb-6">
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-gray-900">
            Nos <span style="color:#E8184A;">Produits</span>
        </h1>
        <p class="mt-2 text-sm" style="color:#888;">
            Découvrez notre sélection · Livraison express partout au Cameroun
        </p>
    </div>

    {{-- ─── Filtres catégories ──────────────────────────────── --}}
    <div class="flex gap-2 overflow-x-auto scrollbar-hide pb-2 mb-6">
        <a href="{{ route('produits.produit') }}"
           class="filter-chip {{ !request('categorie') ? 'active' : '' }}">
            Tout
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('produits.index', ['categorie' => $cat->id]) }}"
           class="filter-chip {{ request('categorie') == $cat->id ? 'active' : '' }}">
            {{ $cat->nom }}
        </a>
        @endforeach
    </div>

    {{-- ─── Grille produits ────────────────────────────────── --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-5">

        @foreach($produits as $index => $produit)

            {{-- Premier produit = carte featured pleine largeur --}}
            @if($index === 0)
            <div class="featured-card col-span-2 sm:col-span-3 lg:col-span-4">

                {{-- Image zone --}}
                <div class="relative flex-shrink-0 w-36 sm:w-52 flex items-center justify-center"
                     style="background:linear-gradient(135deg,#fff0f3,#fce4ec); min-height:150px;">

                    @if($produit->image_principale)
                        <img src="{{ Storage::url($produit->image_principale) }}"
                             alt="{{ $produit->nom }}"
                             class="w-full h-full object-cover">
                    @else
                        <svg class="w-14 h-14 opacity-20" fill="none" stroke="#E8184A" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    @endif

                    {{-- Badge promo flottant --}}
                    <span class="absolute bottom-3 right-3 flex items-center gap-1 text-xs font-bold px-3 py-1.5 rounded-2xl"
                          style="background:#fff; color:#E8184A; box-shadow:0 2px 8px rgba(0,0,0,0.12);">
                        ⚡ -20% cette semaine
                    </span>
                </div>

                {{-- Contenu --}}
                <div class="flex flex-col justify-between p-4 sm:p-6 flex-1">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider" style="color:#E8184A;">
                            {{ $produit->categorie->nom ?? 'Coup de cœur' }}
                        </span>
                        <h2 class="mt-1 text-lg sm:text-xl font-extrabold text-gray-900 leading-snug">
                            {{ $produit->nom }}
                        </h2>
                        <p class="mt-1 text-xs sm:text-sm line-clamp-2" style="color:#888;">
                            {{ $produit->description }}
                        </p>
                    </div>
                    <div class="flex items-end justify-between mt-4">
                        <div>
                            @if($produit->prix_original ?? false)
                            <p class="text-xs line-through" style="color:#aaa;">
                                {{ number_format($produit->prix_original, 0, ',', ' ') }} FCFA
                            </p>
                            @endif
                            <p class="text-2xl font-extrabold" style="color:#E8184A;">
                                {{ number_format($produit->prix, 0, ',', ' ') }} FCFA
                            </p>
                        </div>
                        <a href="{{ route('produits.show', $produit->id) }}"
                           class="btn-pink text-sm px-5 py-2.5">
                            Voir détails
                        </a>
                    </div>
                </div>
            </div>

            {{-- Cartes normales --}}
            @else
            <div class="product-card">

                {{-- Image --}}
                <div class="relative overflow-hidden" style="aspect-ratio:1; background:#fafafa;">
                    @if($produit->image_principale)
                        <img src="{{ Storage::url($produit->image_principale) }}"
                             alt="{{ $produit->nom }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full flex items-center justify-center"
                             style="background:linear-gradient(135deg,#fff0f3,#fce4ec);">
                            <svg class="w-10 h-10 opacity-20" fill="none" stroke="#E8184A" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Badge --}}
                    @if($produit->prix_original ?? false)
                        @php $reduction = round((1 - $produit->prix / $produit->prix_original) * 100); @endphp
                        <span class="absolute top-2 left-2 text-xs font-bold px-2 py-1 rounded-full"
                              style="background:#E8184A; color:#fff;">-{{ $reduction }}%</span>
                    @elseif($produit->is_new ?? false)
                        <span class="absolute top-2 left-2 text-xs font-bold px-2 py-1 rounded-full"
                              style="background:#F5A623; color:#fff;">NOUVEAU</span>
                    @endif

                    {{-- Favoris --}}
                    <button class="absolute top-2 right-2 w-7 h-7 flex items-center justify-center rounded-full"
                            style="background:rgba(255,255,255,0.9); box-shadow:0 1px 4px rgba(0,0,0,0.1);">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="#E8184A" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>

                {{-- Contenu --}}
                <div class="flex flex-col flex-grow p-3">
                    <span class="text-xs font-semibold uppercase tracking-wider" style="color:#E8184A;">
                        {{ $produit->categorie->nom ?? '' }}
                    </span>
                    <h3 class="mt-1 text-sm font-bold text-gray-900 line-clamp-2 flex-grow leading-snug">
                        {{ $produit->nom }}
                    </h3>

                    {{-- Étoiles --}}
                    <p class="mt-1.5 text-xs" style="color:#F5A623; letter-spacing:1px;">★★★★☆</p>

                    {{-- Prix + panier --}}
                    <div class="flex items-center justify-between mt-2 pt-2" style="border-top:1px solid #f0f0f0;">
                        <div>
                            @if($produit->prix_original ?? false)
                            <p class="text-xs line-through" style="color:#aaa;">
                                {{ number_format($produit->prix_original, 0, ',', ' ') }} FCFA
                            </p>
                            @endif
                            <p class="text-sm sm:text-base font-extrabold" style="color:#E8184A;">
                                {{ number_format($produit->prix, 0, ',', ' ') }}
                                <span class="text-xs font-semibold">FCFA</span>
                            </p>
                        </div>
                        <a href="{{ route('produits.show', $produit->id) }}" class="btn-cart">
                            <svg class="w-4 h-4" fill="none" stroke="#fff" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endif

        @endforeach
    </div>

    {{-- ─── Aucun produit ──────────────────────────────────── --}}
    @if($produits->isEmpty())
    <div class="text-center py-24">
        <svg class="w-16 h-16 mx-auto mb-4 opacity-20" fill="none" stroke="#E8184A" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/>
        </svg>
        <p class="text-lg font-bold text-gray-700">Aucun produit disponible</p>
        <p class="text-sm mt-1 text-gray-400">Revenez bientôt pour découvrir nos nouveautés.</p>
    </div>
    @endif

    {{-- ─── Pagination ─────────────────────────────────────── --}}
    @if($produits->hasPages())
    <div class="flex justify-center gap-2 mt-10">
        @if($produits->onFirstPage())
            <span class="pg-btn opacity-40 cursor-not-allowed">‹</span>
        @else
            <a href="{{ $produits->previousPageUrl() }}" class="pg-btn">‹</a>
        @endif

        @foreach($produits->getUrlRange(1, $produits->lastPage()) as $page => $url)
            @if($page == $produits->currentPage())
                <span class="pg-btn active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="pg-btn">{{ $page }}</a>
            @endif
        @endforeach

        @if($produits->hasMorePages())
            <a href="{{ $produits->nextPageUrl() }}" class="pg-btn">›</a>
        @else
            <span class="pg-btn opacity-40 cursor-not-allowed">›</span>
        @endif
    </div>
    @endif

</div>
</div>














        
            <!-- Alpine.js for interactivity -->
            <script src="//unpkg.com/alpinejs" defer></script>
            
            <!-- Contenu principal -->
            
    <!-- Footer -->
    <footer class="bg-gradient-to-r from-primary-900 via-gray-900 to-primary-900 text-gray-200 mt-16 shadow-2xl relative z-10 overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <svg class="w-full h-full" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="300" cy="200" r="300" fill="#2DD4BF"/>
                <circle cx="900" cy="350" r="250" fill="#F472B6"/>
                <circle cx="1200" cy="150" r="200" fill="#F59E42"/>
            </svg>
        </div>
        <div class="max-w-7xl mx-auto px-4 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <!-- À propos (interactive icon + reveal more) -->
                <div x-data="{ open: false }" class="space-y-2">
                    <button @mouseover="open=true" @mouseleave="open=false" class="flex items-center gap-2 group">
                        <svg class="w-6 h-6 text-primary-400 group-hover:animate-spin" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 3v2m6.364 1.636l-1.414 1.414M21 12h-2m-1.636 6.364l-1.414-1.414M12 21v-2m-6.364-1.636l1.414-1.414M3 12h2m1.636-6.364l1.414 1.414" /></svg>
                        <h3 class="text-white font-bold text-lg">À propos</h3>
                    </button>
                    <div x-show="open" x-transition class="bg-gray-800 shadow-lg rounded p-3 mt-2 text-sm text-gray-300">
                        ShopCM est votre boutique en ligne de confiance au Cameroun.<br>
                        Livraison rapide dans tout le pays.<br>
                        <span class="font-semibold text-primary-400">Rejoignez-nous pour découvrir nos nouveautés !</span>
                    </div>
                </div>
                
                <!-- Liens rapides (hover underline & active highlight) -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Liens rapides</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="block px-2 py-1 rounded transition hover:bg-primary-900 hover:underline hover:underline-offset-4 active:bg-primary-700">Accueil</a></li>
                        <li><a href="{{ route('produits.produit') }}" class="block px-2 py-1 rounded transition hover:bg-primary-900 hover:underline hover:underline-offset-4 active:bg-primary-700">Produits</a></li>
                        <li><a href="{{ route('a-propos') }}" class="block px-2 py-1 rounded transition hover:bg-primary-900 hover:underline hover:underline-offset-4 active:bg-primary-700">À propos</a></li>
                        <li><a href="{{ route('contact') }}" class="block px-2 py-1 rounded transition hover:bg-primary-900 hover:underline hover:underline-offset-4 active:bg-primary-700">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Service client (dropdown FAQ on hover) -->
                <div class="relative group">
                    <h3 class="text-white font-bold text-lg mb-4 flex items-center">
                        Service client
                        <svg class="ml-2 w-4 h-4 text-primary-400 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                    </h3>
                    <ul class="space-y-2 text-sm">
                        <li class="relative">
                            <a href="{{ route('faq') }}" class="block px-2 py-1 rounded transition hover:bg-primary-900 hover:underline hover:underline-offset-4 active:bg-primary-700">
                                FAQ
                            </a>
                            <div class="absolute left-full top-0 ml-2 w-48 hidden group-hover:block bg-gray-800 p-2 rounded shadow-lg border border-primary-900 transition">
                                <span class="text-xs text-primary-400">Des questions fréquemment posées pour vous assister rapidement.</span>
                            </div>
                        </li>
                        <li><a href="#" class="block px-2 py-1 rounded transition hover:bg-primary-900 hover:underline hover:underline-offset-4 active:bg-primary-700">Livraison</a></li>
                        <li><a href="#" class="block px-2 py-1 rounded transition hover:bg-primary-900 hover:underline hover:underline-offset-4 active:bg-primary-700">Retours</a></li>
                        <li><a href="#" class="block px-2 py-1 rounded transition hover:bg-primary-900 hover:underline hover:underline-offset-4 active:bg-primary-700">Conditions</a></li>
                    </ul>
                </div>
                
                <!-- Contact + Animated Socials -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm mb-4">
                        <li class="flex items-center gap-2 hover:text-primary-400 transition">
                            <i class="fas fa-phone text-primary-400"></i>
                            <a href="tel:+237622177314" class="hover:underline">+237 622177314</a>
                        </li>
                        <li class="flex items-center gap-2 hover:text-primary-400 transition">
                            <i class="fas fa-envelope text-primary-400"></i>
                            <a href="mailto:contact@shopcm.cm" class="hover:underline">contact@shopcm.cm</a>
                        </li>
                        <li class="flex items-center gap-2 hover:text-primary-400 transition">
                            <i class="fas fa-map-marker-alt text-primary-400"></i>
                            Yaoundé, Cameroun
                        </li>
                    </ul>
                    <!-- Socials animated -->
                    <div class="flex space-x-4 mt-2">
                        <a href="#" class="group transition" aria-label="Facebook">
                            <i class="fab fa-facebook text-xl text-gray-400 group-hover:text-primary-400 transition duration-200 group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="group transition" aria-label="Instagram">
                            <i class="fab fa-instagram text-xl text-gray-400 group-hover:text-primary-400 transition duration-200 group-hover:scale-110"></i>
                        </a>
                        <a href="#" class="group transition" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp text-xl text-gray-400 group-hover:text-primary-400 transition duration-200 group-hover:scale-110"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="border-gray-700 my-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm">
                <p>&copy; 2024 <span class="text-primary-400 font-bold">ShopCM</span>. Tous droits réservés.</p>
                <div class="flex items-center gap-2">
                    <span>Suivez-nous:</span>
                    <a href="#" class="group transition" title="Facebook">
                        <i class="fab fa-facebook text-lg text-primary-400 group-hover:text-fuchsia-400 transition duration-150"></i>
                    </a>
                    <a href="#" class="group transition" title="Instagram">
                        <i class="fab fa-instagram text-lg text-fuchsia-400 group-hover:text-primary-400 transition duration-150"></i>
                    </a>
                    <a href="#" class="group transition" title="WhatsApp">
                        <i class="fab fa-whatsapp text-lg text-green-400 group-hover:text-primary-400 transition duration-150"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
     
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Scripts personnalisés -->
    <script>
        // Menu mobile
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Auto-fermeture des messages après 5 secondes
        setTimeout(() => {
            const alerts = document.querySelectorAll('.bg-green-50, .bg-red-50');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>
