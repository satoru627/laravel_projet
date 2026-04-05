<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class PanierController extends Controller
{
    /**
     * Affiche le panier
     */
    public function index()
    {
        $panier = session('panier', []);
        $total = 0;
        
        $produits = [];
        
        foreach ($panier as $id => $item) {
            $produit = Produit::find($id);
            if ($produit) {
                $prix = $produit->en_promotion && $produit->prix_promo ? $produit->prix_promo : $produit->prix;
                $sousTotal = $prix * $item['quantite'];
                
                $produits[] = [
                    'produit' => $produit,
                    'quantite' => $item['quantite'],
                    'prix' => $prix,
                    'sous_total' => $sousTotal,
                ];
                
                $total += $sousTotal;
            }
        }
        
        return view('panier.index', compact('produits', 'total'));
    }
    
    /**
     * Ajoute un produit au panier
     */
    public function ajouter(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);
        
        $produit = Produit::findOrFail($request->produit_id);
        
        // Vérifier le stock
        if ($produit->stock < $request->quantite) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuffisant',
            ], 400);
        }
        
        $panier = session('panier', []);
        
        // Si le produit existe déjà dans le panier
        if (isset($panier[$produit->id])) {
            $nouvelleQuantite = $panier[$produit->id]['quantite'] + $request->quantite;
            
            if ($nouvelleQuantite > $produit->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuffisant',
                ], 400);
            }
            
            $panier[$produit->id]['quantite'] = $nouvelleQuantite;
        } else {
            // Ajouter un nouveau produit
            $panier[$produit->id] = [
                'quantite' => $request->quantite,
            ];
        }
        
        session(['panier' => $panier]);
        
        return response()->json([
            'success' => true,
            'message' => 'Produit ajouté au panier',
            'count' => count($panier),
        ]);
    }
    
    /**
     * Modifie la quantité d'un produit
     */
    public function modifier(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'quantite' => 'required|integer|min:1',
        ]);
        
        $produit = Produit::findOrFail($request->produit_id);
        
        if ($produit->stock < $request->quantite) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuffisant',
            ], 400);
        }
        
        $panier = session('panier', []);
        
        if (isset($panier[$produit->id])) {
            $panier[$produit->id]['quantite'] = $request->quantite;
            session(['panier' => $panier]);
            
            return response()->json([
                'success' => true,
                'message' => 'Quantité mise à jour',
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Produit non trouvé dans le panier',
        ], 404);
    }
    
    /**
     * Supprime un produit du panier
     */
    public function supprimer($id)
    {
        $panier = session('panier', []);
        
        if (isset($panier[$id])) {
            unset($panier[$id]);
            session(['panier' => $panier]);
            
            return redirect()->route('panier.index')->with('success', 'Produit retiré du panier');
        }
        
        return redirect()->route('panier.index')->with('error', 'Produit non trouvé');
    }
}
