@extends('layouts.app')

@section('title', 'Dashboard Administrateur')

@section('content')

<div class="bg-gray-100 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                <i class="fas fa-chart-line text-primary-600 mr-2"></i>
                Dashboard Administrateur
            </h1>
            <p class="text-gray-600">Bienvenue {{ auth()->user()->prenom }} ! Voici un aperçu de votre boutique.</p>
        </div>
        
        <!-- Cartes statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total clients -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold mb-1">Total Clients</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['total_clients'] }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Total produits -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold mb-1">Total Produits</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['total_produits'] }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-box text-green-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Total commandes -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold mb-1">Total Commandes</p>
                        <h3 class="text-3xl font-bold text-gray-900">{{ $stats['total_commandes'] }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-purple-600 text-2xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Revenus total -->
            <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-primary-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold mb-1">Revenus Total</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($stats['revenus_total'], 0, ',', ' ') }} FCFA</h3>
                    </div>
                    <div class="w-14 h-14 bg-primary-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-money-bill-wave text-primary-600 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Alertes -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Commandes en attente -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-yellow-600 text-3xl"></i>
                    </div>
                    <div class="ml-4 flex-1">
                        <h4 class="text-lg font-bold text-yellow-900">{{ $stats['commandes_en_attente'] }} commandes en attente</h4>
                        <p class="text-yellow-700 text-sm">Des commandes nécessitent votre attention</p>
                    </div>
                    <a href="{{ route('admin.commandes.index') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition font-semibold">
                        Voir
                    </a>
                </div>
            </div>
            
            <!-- Produits en rupture -->
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-box-open text-red-600 text-3xl"></i>
                    </div>
                    <div class="ml-4 flex-1">
                        <h4 class="text-lg font-bold text-red-900">{{ $stats['produits_rupture'] }} produits en rupture</h4>
                        <p class="text-red-700 text-sm">Réapprovisionner rapidement</p>
                    </div>
                    <a href="{{ route('admin.produits.index') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                        Voir
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Graphiques et données -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Ventes par mois -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    <i class="fas fa-chart-bar text-primary-600 mr-2"></i>
                    Ventes des 6 derniers mois
                </h3>
                <canvas id="ventesChart" height="200"></canvas>
            </div>
            
            <!-- Produits populaires -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    <i class="fas fa-fire text-red-600 mr-2"></i>
                    Top 5 Produits
                </h3>
                <div class="space-y-4">
                    @foreach($produitsPopulaires as $item)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <img src="{{ Storage::url($item['produit']->image_principale) }}" alt="{{ $item['produit']->nom }}" class="w-12 h-12 object-cover rounded">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $item['produit']->nom }}</p>
                                <p class="text-sm text-gray-500">{{ number_format($item['produit']->prix, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                        <span class="bg-primary-100 text-primary-800 px-3 py-1 rounded-full text-sm font-bold">
                            {{ $item['total_vendu'] }} vendus
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Dernières commandes -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900">
                    <i class="fas fa-receipt text-primary-600 mr-2"></i>
                    Dernières Commandes
                </h3>
                <a href="{{ route('admin.commandes.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold text-sm">
                    Voir tout <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">N° Commande</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Client</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Total</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Statut</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($dernieresCommandes as $commande)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4">
                                <span class="font-semibold text-primary-600">{{ $commande->numero_commande }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <p class="font-medium text-gray-900">{{ $commande->user->nom_complet }}</p>
                                <p class="text-sm text-gray-500">{{ $commande->user->email }}</p>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600">
                                {{ $commande->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-4 font-bold text-gray-900">
                                {{ number_format($commande->total, 0, ',', ' ') }} FCFA
                            </td>
                            <td class="px-4 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-{{ $commande->statut_badge['color'] }}-100 text-{{ $commande->statut_badge['color'] }}-800">
                                    {{ $commande->statut_badge['label'] }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <a href="{{ route('admin.commandes.show', $commande->id) }}" class="text-primary-600 hover:text-primary-700 font-semibold text-sm">
                                    <i class="fas fa-eye mr-1"></i> Détails
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Actions rapides -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <a href="{{ route('admin.produits.create') }}" class="bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl shadow-lg p-6 hover:from-green-700 hover:to-green-800 transition transform hover:scale-105">
                <i class="fas fa-plus-circle text-3xl mb-3"></i>
                <h4 class="font-bold text-lg mb-1">Ajouter un produit</h4>
                <p class="text-green-100 text-sm">Créer un nouveau produit</p>
            </a>
            
            <a href="{{ route('admin.categories.create') }}" class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl shadow-lg p-6 hover:from-blue-700 hover:to-blue-800 transition transform hover:scale-105">
                <i class="fas fa-folder-plus text-3xl mb-3"></i>
                <h4 class="font-bold text-lg mb-1">Nouvelle catégorie</h4>
                <p class="text-blue-100 text-sm">Organiser vos produits</p>
            </a>
            
            <a href="{{ route('admin.commandes.index') }}" class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl shadow-lg p-6 hover:from-purple-700 hover:to-purple-800 transition transform hover:scale-105">
                <i class="fas fa-clipboard-list text-3xl mb-3"></i>
                <h4 class="font-bold text-lg mb-1">Gérer les commandes</h4>
                <p class="text-purple-100 text-sm">Suivre les commandes</p>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Graphique des ventes
const ctx = document.getElementById('ventesChart').getContext('2d');
const ventesData = @json($ventesMois);
const labels = ventesData.map(item => item.mois);
const data = ventesData.map(item => item.total);
const backgroundColors = [
    '#f87171', '#fbbf24', '#34d399', '#60a5fa', '#a78bfa', '#f472b6',
    '#c084fc', '#38bdf8', '#f9a8d4', '#fde68a', '#a3e635', '#facc15'
];
while(backgroundColors.length < labels.length) {
    backgroundColors.push(...backgroundColors);
}

const ventesChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labels,
        datasets: [{
            label: 'Répartion des ventes (FCFA)',
            data: data,
            backgroundColor: backgroundColors.slice(0, labels.length),
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true, position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let value = context.parsed;
                        return context.label + ': ' + value.toLocaleString() + ' FCFA';
                    }
                }
            }
        }
    }
});
// Ajout de l'interaction: click sur le graphique affiche la proportion du segment
document.getElementById('ventesChart').onclick = function(evt) {
    const points = ventesChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
    if (points.length) {
        const firstPoint = points[0];
        const label = ventesChart.data.labels[firstPoint.index];
        const value = ventesChart.data.datasets[firstPoint.datasetIndex].data[firstPoint.index];
        alert(`Mois : ${label}\nTotal ventes : ${value.toLocaleString()} FCFA`);
    }
};

function copierCommande(numero) {
    navigator.clipboard.writeText(numero);
    // Notification toast
    let toast = document.createElement('div');
    toast.innerText = "Numéro de commande copié !";
    toast.className = "fixed top-6 right-8 bg-primary-600 text-white px-5 py-2 rounded shadow-xl z-50 animate-bounce";
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 2000);
}
</script>
@endpush