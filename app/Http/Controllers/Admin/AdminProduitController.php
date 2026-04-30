<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Produit;
use App\Models\Categorie;

class AdminProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::where('actif', true)->get();
        return view('admin.produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'             => 'required|string|max:255',
            'description'     => 'nullable|string',
            'prix'            => 'required|numeric|min:0',
            'prix_promo'      => 'nullable|numeric|min:0',
            'stock'           => 'nullable|integer|min:0',
            'categorie_id'    => 'nullable|exists:categories,id',
            // ✅ Le fichier est optionnel ici, on le rend required en dessous
            'image_principale' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ✅ Un seul endroit pour gérer l'upload
        $imagePath = $request->file('image_principale')->store('produits', 'public');

        Produit::create([
            'nom'              => $validated['nom'],
            'description'      => $validated['description'] ?? 'Description à compléter',
            'prix'             => $validated['prix'],
            'prix_promo'       => $validated['prix_promo'] ?? null,
            'stock'            => $validated['stock'] ?? 0,
            'categorie_id'     => $validated['categorie_id'] ?? null,
            'image_principale' => $imagePath,
            'en_promotion'     => $request->boolean('en_promotion'),
            'en_vedette'       => $request->boolean('en_vedette'),
            'actif'            => $request->boolean('actif'),
        ]);

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit créé avec succès !');
    }

    public function show($id)
    {
        // ✅ Suppression de la relation commande inexistante sur Produit
        $produit = Produit::with('categorie')->findOrFail($id);

        return view('admin.produits.show', compact('produit'));
    }

    public function edit($id)
    {
        $produit    = Produit::findOrFail($id);
        $categories = Categorie::where('actif', true)->get();

        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);

        $validated = $request->validate([
            'nom'              => 'required|string|max:255',
            'description'      => 'nullable|string',
            'prix'             => 'required|numeric|min:0',
            'prix_promo'       => 'nullable|numeric|min:0',
            'stock'            => 'nullable|integer|min:0',
            'categorie_id'     => 'nullable|exists:categories,id',
            // ✅ nullable : l'image n'est pas obligatoire lors de l'édition
            'image_principale' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ✅ Upload uniquement si un nouveau fichier est envoyé
        $imagePath = $produit->image_principale; // on garde l'ancienne par défaut

        if ($request->hasFile('image_principale')) {
            // Supprimer l'ancienne image du disque
            if ($produit->image_principale) {
                Storage::disk('public')->delete($produit->image_principale);
            }
            $imagePath = $request->file('image_principale')->store('produits', 'public');
        }

        $produit->update([
            'nom'              => $validated['nom'],
            'description'      => $validated['description'] ?? $produit->description,
            'prix'             => $validated['prix'],
            'prix_promo'       => $validated['prix_promo'] ?? null,
            'stock'            => $validated['stock'] ?? $produit->stock,
            'categorie_id'     => $validated['categorie_id'] ?? $produit->categorie_id,
            'image_principale' => $imagePath,
            'en_promotion'     => $request->boolean('en_promotion'),
            'en_vedette'       => $request->boolean('en_vedette'),
            'actif'            => $request->boolean('actif'),
        ]);

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit modifié avec succès !');
    }

    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);

        // ✅ Nettoyage du fichier avant suppression
        if ($produit->image_principale) {
            Storage::disk('public')->delete($produit->image_principale);
        }

        $produit->delete();

        return redirect()->route('admin.produits.index')
            ->with('success', 'Produit supprimé avec succès !');
    }
}