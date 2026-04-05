<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorie;

class AdminCategorieController extends Controller
{
    /**
     * Affiche la liste des catégories
     */
    public function index()
    {
        $categories = Categorie::withCount('produits')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Enregistre une nouvelle catégorie
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'actif' => 'boolean',
        ], [
            'nom.required' => 'Le nom est obligatoire',
            'nom.unique' => 'Cette catégorie existe déjà',
        ]);

        Categorie::create([
            'nom' => $validated['nom'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'actif' => $request->has('actif'),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès !');
    }

    /**
     * Affiche les détails d'une catégorie
     */
    public function show($id)
    {
        $categorie = Categorie::withCount('produits')->findOrFail($id);
        $produits = $categorie->produits()->paginate(12);
        
        return view('admin.categories.show', compact('categorie', 'produits'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categories.edit', compact('categorie'));
    }

    /**
     * Met à jour une catégorie
     */
    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        $categorie->update([
            'nom' => $validated['nom'],
            'description' => $validated['description'] ?? null,
            'image' => $validated['image'] ?? null,
            'actif' => $request->has('actif'),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès !');
    }

    /**
     * Supprime une catégorie
     */
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        
        if ($categorie->produits()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des produits.');
        }
        
        $categorie->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès !');
    }
}
