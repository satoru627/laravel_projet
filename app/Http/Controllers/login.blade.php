@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-white py-12 px-4">
    <div class="max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center">
                <i class="fas fa-sign-in-alt text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Bon retour !</h1>
            <p class="text-gray-600">Connectez-vous pour continuer vos achats</p>
        </div>
        
        <!-- Formulaire -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-1"></i>
                        Email
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required
                           autofocus
                           placeholder="votre@email.com"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>
                        Mot de passe
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               placeholder="••••••••"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('password') border-red-500 @enderror">
                        <button type="button" 
                                onclick="togglePassword('password')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Se souvenir de moi / Mot de passe oublié -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                        <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                    
                    <a href="#" class="text-sm text-primary-600 hover:text-primary-700 font-semibold">
                        Mot de passe oublié ?
                    </a>
                </div>
                
                <!-- Bouton de soumission -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-3 rounded-lg font-bold hover:from-primary-700 hover:to-primary-800 transition transform hover:scale-105 shadow-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Se connecter
                </button>
            </form>
            
            <!-- Lien inscription -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Vous n'avez pas de compte ? 
                    <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                        S'inscrire gratuitement
                    </a>
                </p>
            </div>
            
            <!-- Divider -->
            <div class="my-6 flex items-center">
                <div class="flex-1 border-t border-gray-300"></div>
                <span class="px-4 text-sm text-gray-500">OU</span>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>
            
            <!-- Connexion rapide demo -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-sm font-semibold text-blue-900 mb-2">
                    <i class="fas fa-info-circle mr-1"></i>
                    Compte de démonstration
                </p>
                <p class="text-xs text-blue-700 mb-2">Pour tester l'interface administrateur :</p>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div>
                        <strong>Email:</strong><br>
                        <code class="bg-white px-2 py-1 rounded">admin@shopcm.cm</code>
                    </div>
                    <div>
                        <strong>Mot de passe:</strong><br>
                        <code class="bg-white px-2 py-1 rounded">password</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eye = document.getElementById(fieldId + '-eye');
    
    if (field.type === 'password') {
        field.type = 'text';
        eye.classList.remove('fa-eye');
        eye.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        eye.classList.remove('fa-eye-slash');
        eye.classList.add('fa-eye');
    }
}
</script>
@endpush
