<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;

class ProduitController extends Controller
{
    /**
     * Affiche la liste des produits
     */
    public function index(Request $request)
    {
        $query = Produit::where('actif', true);
        
        // Recherche par nom
        if ($request->has('search') && $request->search) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }
        
        // Filtre par catégorie
        if ($request->has('categorie') && $request->categorie) {
            $query->where('categorie_id', $request->categorie);
        }
        
        // Filtre par prix
        if ($request->has('prix_min')) {
            $query->where('prix', '>=', $request->prix_min);
        }
        if ($request->has('prix_max')) {
            $query->where('prix', '<=', $request->prix_max);
        }
        
        // Tri
        $sort = $request->get('sort', 'recent');
        switch ($sort) {
            case 'prix_asc':
                $query->orderBy('prix', 'asc');
                break;
            case 'prix_desc':
                $query->orderBy('prix', 'desc');
                break;
            case 'nom':
                $query->orderBy('nom', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $produits = $query->paginate(12);
        $categories = Categorie::where('actif', true)->get();
        
        return view('produits.index', compact('produits', 'categories'));
    }
    
    /**
     * Affiche les détails d'un produit
     */
    public function show($id)
    {
        $produit = Produit::where('actif', true)->findOrFail($id);
        
        // Produits similaires
        $produitsSimilaires = Produit::where('categorie_id', $produit->categorie_id)
            ->where('id', '!=', $produit->id)
            ->where('actif', true)
            ->take(4)
            ->get();
        
        return view('produits.show', compact('produit', 'produitsSimilaires'));
    }
    
    /**
     * Affiche les produits d'une catégorie
     */
    public function categorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        
        $produits = Produit::where('categorie_id', $id)
            ->where('actif', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        $categories = Categorie::where('actif', true)->get();
        
        return view('produits.index', compact('produits', 'categories', 'categorie'));
    }
}
