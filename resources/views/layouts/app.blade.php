

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'E-Commerce') - Boutique en ligne</title>
    
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
                    <a href="{{ route('produits.index') }}" class="text-gray-700 hover:text-primary-600 font-medium transition relative after:block after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-0 hover:after:w-full after:bg-primary-600 after:transition-all after:duration-300">
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
                <a href="{{ route('produits.index') }}" class="block text-gray-700 hover:text-primary-600 font-medium transition">
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

    <!-- Alpine.js for interactivity -->
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <!-- Contenu principal -->
    <main class="min-h-screen">
        @yield('content')
    </main>
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
