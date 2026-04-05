<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     */
    public function index()
    {
        // Récupérer les catégories avec le nombre de produits
        $categories = Categorie::where('actif', true)
            ->withCount('produits')
            ->take(8)
            ->get();
        
        // Récupérer les produits en vedette
        $produitsVedette = Produit::where('en_vedette', true)
            ->where('actif', true)
            ->where('stock', '>', 0)
            ->take(8)
            ->get();
        
        // Récupérer les produits en promotion
        $produitsPromo = Produit::where('en_promotion', true)
            ->where('actif', true)
            ->where('stock', '>', 0)
            ->whereNotNull('prix_promo')
            ->take(8)
            ->get();
        
        return view('home', compact('categories', 'produitsVedette', 'produitsPromo'));
    }
}
