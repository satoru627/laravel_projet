@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-primary-50 to-white py-12 px-4">
    <div class="max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center">
                <i class="fas fa-user-plus text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Créer un compte</h1>
            <p class="text-gray-600">Rejoignez-nous pour profiter de nos offres exclusives</p>
        </div>
        
        <!-- Formulaire -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Nom et Prénom -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nom <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                               id="nom" 
                               name="nom" 
                               value="{{ old('nom') }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('nom') border-red-500 @enderror">
                        @error('nom')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="prenom" class="block text-sm font-semibold text-gray-700 mb-2">
                            Prénom <span class="text-red-600">*</span>
                        </label>
                        <input type="text" 
                               id="prenom" 
                               name="prenom" 
                               value="{{ old('prenom') }}"
                               required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('prenom') border-red-500 @enderror">
                        @error('prenom')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-1"></i>
                        Email <span class="text-red-600">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}"
                           required
                           placeholder="votre@email.com"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Téléphone -->
                <div>
                    <label for="telephone" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-phone text-gray-400 mr-1"></i>
                        Téléphone
                    </label>
                    <input type="tel" 
                           id="telephone" 
                           name="telephone" 
                           value="{{ old('telephone') }}"
                           placeholder="+237 6XX XXX XXX"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('telephone') border-red-500 @enderror">
                    @error('telephone')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Adresse -->
                <div>
                    <label for="adresse" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i>
                        Adresse
                    </label>
                    <input type="text" 
                           id="adresse" 
                           name="adresse" 
                           value="{{ old('adresse') }}"
                           placeholder="Votre adresse"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('adresse') border-red-500 @enderror">
                    @error('adresse')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Ville et Code postal -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="ville" class="block text-sm font-semibold text-gray-700 mb-2">
                            Ville
                        </label>
                        <select id="ville" 
                                name="ville" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('ville') border-red-500 @enderror">
                            <option value="">Sélectionner</option>
                            <option value="Yaoundé" {{ old('ville') == 'Yaoundé' ? 'selected' : '' }}>Yaoundé</option>
                            <option value="Douala" {{ old('ville') == 'Douala' ? 'selected' : '' }}>Douala</option>
                            <option value="Bafoussam" {{ old('ville') == 'Bafoussam' ? 'selected' : '' }}>Bafoussam</option>
                            <option value="Garoua" {{ old('ville') == 'Garoua' ? 'selected' : '' }}>Garoua</option>
                            <option value="Bamenda" {{ old('ville') == 'Bamenda' ? 'selected' : '' }}>Bamenda</option>
                            <option value="Bertoua" {{ old('ville') == 'Bertoua' ? 'selected' : '' }}>Bertoua</option>
                            <option value="Maroua" {{ old('ville') == 'Maroua' ? 'selected' : '' }}>Maroua</option>
                            <option value="Ngaoundéré" {{ old('ville') == 'Ngaoundéré' ? 'selected' : '' }}>Ngaoundéré</option>
                        </select>
                        @error('ville')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="code_postal" class="block text-sm font-semibold text-gray-700 mb-2">
                            Code postal
                        </label>
                        <input type="text" 
                               id="code_postal" 
                               name="code_postal" 
                               value="{{ old('code_postal') }}"
                               placeholder="00000"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition @error('code_postal') border-red-500 @enderror">
                        @error('code_postal')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>
                        Mot de passe <span class="text-red-600">*</span>
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
                    <p class="text-xs text-gray-500 mt-1">Minimum 8 caractères</p>
                </div>
                
                <!-- Confirmation mot de passe -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-1"></i>
                        Confirmer le mot de passe <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               placeholder="••••••••"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition">
                        <button type="button" 
                                onclick="togglePassword('password_confirmation')"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fas fa-eye" id="password_confirmation-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Conditions -->
                <div class="flex items-start">
                    <input type="checkbox" 
                           id="terms" 
                           name="terms" 
                           required
                           class="mt-1 h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="terms" class="ml-2 text-sm text-gray-600">
                        J'accepte les <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold">conditions d'utilisation</a> 
                        et la <a href="#" class="text-primary-600 hover:text-primary-700 font-semibold">politique de confidentialité</a>
                    </label>
                </div>
                
                <!-- Bouton de soumission -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white py-3 rounded-lg font-bold hover:from-primary-700 hover:to-primary-800 transition transform hover:scale-105 shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i>
                    Créer mon compte
                </button>
            </form>
            
            <!-- Lien connexion -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">
                    Vous avez déjà un compte ? 
                    <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-semibold">
                        Se connecter
                    </a>
                </p>
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
