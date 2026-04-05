<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\Categorie;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Affiche le dashboard administrateur
     */
    public function index()
    {
        // Statistiques globales
        $stats = [
            'total_clients' => User::where('role', 'client')->count(),
            'total_produits' => Produit::count(),
            'total_commandes' => Commande::count(),
            'total_categories' => Categorie::count(),
        ];
        
        // Revenus
        $stats['revenus_total'] = Commande::where('statut', '!=', 'annulee')->sum('total');
        $stats['revenus_mois'] = Commande::where('statut', '!=', 'annulee')
            ->whereMonth('created_at', now()->month)
            ->sum('total');
        
        // Commandes en attente
        $stats['commandes_en_attente'] = Commande::where('statut', 'en_attente')->count();
        
        // Produits en rupture de stock
        $stats['produits_rupture'] = Produit::where('stock', '<=', 0)->count();
        
        // Dernières commandes
        $dernieresCommandes = Commande::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        // Produits les plus vendus
        $produitsPopulaires = DB::table('details_commande')
            ->select('produit_id', DB::raw('SUM(quantite) as total_vendu'))
            ->groupBy('produit_id')
            ->orderBy('total_vendu', 'desc')
            ->take(5)
            ->get();
        
        $produitsPopulaires = $produitsPopulaires->map(function ($item) {
            $produit = Produit::find($item->produit_id);
            return [
                'produit' => $produit,
                'total_vendu' => $item->total_vendu,
            ];
        });
        
        // Ventes par mois (6 derniers mois)
        $ventesMois = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $ventesMois[] = [
                'mois' => $date->format('M Y'),
                'total' => Commande::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->where('statut', '!=', 'annulee')
                    ->sum('total'),
            ];
        }
        
        return view('admin.dashboard', compact('stats', 'dernieresCommandes', 'produitsPopulaires', 'ventesMois'));
    }
}
