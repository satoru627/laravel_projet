@extends('layouts.app')

@section('title', 'Gestion des Commandes')

@section('content')
<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-bold text-gray-900 mb-8">
            <i class="fas fa-clipboard-list text-primary-600 mr-2"></i>
            Gestion des Commandes
        </h1>
        
        <!-- Filtres -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <form action="{{ route('admin.commandes.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Recherche -->
                <div class="md:col-span-2">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Rechercher par n° commande, nom ou email client..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                
                <!-- Filtre par statut -->
                <div>
                    <select name="statut" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Tous les statuts</option>
                        <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmee" {{ request('statut') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                        <option value="en_preparation" {{ request('statut') == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                        <option value="expediee" {{ request('statut') == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                        <option value="livree" {{ request('statut') == 'livree' ? 'selected' : '' }}>Livrée</option>
                        <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>
                
                <div class="md:col-span-3 flex justify-between">
                    <button type="submit" 
                            class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition">
                        <i class="fas fa-search mr-2"></i>
                        Rechercher
                    </button>
                    
                    <a href="{{ route('admin.commandes.index') }}" 
                       class="text-gray-600 hover:text-primary-600">
                        <i class="fas fa-redo mr-1"></i>
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>
        
        @if($commandes->count() > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">N° Commande</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($commandes as $commande)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="font-semibold text-primary-600">{{ $commande->numero_commande }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $commande->user->nom }} {{ $commande->user->prenom }}</p>
                                <p class="text-sm text-gray-500">{{ $commande->user->email }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $commande->created_at->format('d/m/Y') }}<br>
                                <span class="text-xs text-gray-500">{{ $commande->created_at->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ number_format($commande->total, 0, ',', ' ') }} FCFA
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-{{ $commande->statut_badge['color'] }}-100 text-{{ $commande->statut_badge['color'] }}-800">
                                    {{ $commande->statut_badge['label'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.commandes.show', $commande->id) }}" 
                                   class="bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition text-sm font-semibold">
                                    <i class="fas fa-eye mr-1"></i>
                                    Détails
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.commandes.destroy', $commande->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')" style="margin-top: 10px;"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $commandes->links() }}
            </div>
            <!-- delete commande -->
            
            <!-- Statistiques rapides -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8">
                <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded-lg">
                    <p class="text-yellow-900 font-bold text-2xl">
                        {{ $commandes->where('statut', 'en_attente')->count() }}
                    </p>
                    <p class="text-yellow-700 text-sm">En attente</p>
                </div>
                
                <div class="bg-blue-100 border-l-4 border-blue-500 p-4 rounded-lg">
                    <p class="text-blue-900 font-bold text-2xl">
                        {{ $commandes->where('statut', 'confirmee')->count() }}
                    </p>
                    <p class="text-blue-700 text-sm">Confirmées</p>
                </div>
                
                <div class="bg-purple-100 border-l-4 border-purple-500 p-4 rounded-lg">
                    <p class="text-purple-900 font-bold text-2xl">
                        {{ $commandes->where('statut', 'expediee')->count() }}
                    </p>
                    <p class="text-purple-700 text-sm">Expédiées</p>
                </div>
                
                <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-lg">
                    <p class="text-green-900 font-bold text-2xl">
                        {{ $commandes->where('statut', 'livree')->count() }}
                    </p>
                    <p class="text-green-700 text-sm">Livrées</p>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-12 text-center">
                <i class="fas fa-clipboard-list text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Aucune commande</h3>
                <p class="text-gray-600">Aucune commande ne correspond à vos critères de recherche</p>
            </div>
        @endif
    </div>
</div>
@endsection
