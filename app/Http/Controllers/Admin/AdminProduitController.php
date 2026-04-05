<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;

class AdminProduitController extends Controller
{
    /**
     * Affiche la liste des produits
     */
    public function index()
    {
        $produits = Produit::with('categorie')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.produits.index', compact('produits'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        $categories = Categorie::where('actif', true)->get();
        return view('admin.produits.create', compact('categories'));
    }
   public function store(Request $request)
{
    // 1. On valide sans être trop strict sur le boolean pour l'instant
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'prix' => 'required|numeric|min:0',
        'prix_promo' => 'nullable|numeric|min:0',
        'stock' => 'nullable|integer|min:0',
        'categorie_id' => 'nullable|exists:categories,id',
        'image_principale' => 'required|string',
    ]);

    // 2. Création manuelle pour gérer les checkboxes "on"
    Produit::create([
        'nom' => $validated['nom'],
        'description' => $validated['description'] ?? 'Description à compléter',
        'prix' => $validated['prix'],
        'prix_promo' => $validated['prix_promo'],
        'stock' => $validated['stock'] ?? 0,
        'categorie_id' => $validated['categorie_id'],
        'image_principale' => $validated['image_principale'],
        // On transforme "on" en true, et l'absence en false
        'en_promotion' => $request->has('en_promotion'), 
        'en_vedette' => $request->has('en_vedette'),
        'actif' => $request->has('actif'),
    ]);

    return redirect()->route('admin.produits.index')
        ->with('success', 'Produit créé avec succès !');
}


    /**
     * Affiche les détails d'un produit
     */
    public function show($id)
    {
        $produit = Produit::with('categorie')->findOrFail($id);
        $commande = $this->showCommande($produit->commande_id);
    return view('admin.produits.show', compact('produit', 'commande'));
       
    }
    /**
     * Supprime un produit
     */
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('admin.produits.index')->with('success', 'Produit supprimé avec succès !');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::where('actif', true)->get();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    /**
     * Met à jour un produit
     */
    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'prix_promo' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'categorie_id' => 'nullable|exists:categories,id',
            'image_principale' => 'nullable|string',
        ]);

        $produit->update([
            'nom' => $validated['nom'],
            'description' => $validated['description'] ?? $produit->description,
            'prix' => $validated['prix'],
            'prix_promo' => $validated['prix_promo'] ?? null,
            'stock' => $validated['stock'] ?? $produit->stock,
            'categorie_id' => $validated['categorie_id'] ?? $produit->categorie_id,
            'image_principale' => $validated['image_principale'] ?? $produit->image_principale,
            'en_promotion' => $request->has('en_promotion'),
            'en_vedette' => $request->has('en_vedette'),
            'actif' => $request->has('actif'),
        ]);

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit modifié avec succès !');
    }

    /**
     * Supprime un produit
     */
    // public function destroy($id)
    // {
    //     $produit = Produit::findOrFail($id);
    //     $produit->delete();

    //     return redirect()->route('admin.produits.index')
    //         ->with('success', 'Produit supprimé avec succès !');
    // }
    /**
 * Récupère les informations de la commande liée au produit
 */
private function showCommande($commande_id)
{
    // Si le produit n'a pas d'ID de commande, on retourne null pour éviter l'erreur
    if (!$commande_id) {
        return null;
    }

    // On cherche la commande dans la base de données
    // Remplacez \App\Models\Commande par le nom exact de votre modèle Commande
    return \App\Models\Commande::find($commande_id);
}

}
