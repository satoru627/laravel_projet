<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\DetailCommande;
use App\Models\InventoryMovement;
use App\Models\Payment;
use App\Models\Produit;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\OrderPlacedMail;

class CommandeController extends Controller
{
    /**
     * Page de validation de commande
     */
    public function validation()
    {
        $panier = session('panier', []);
        
        if (empty($panier)) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide');
        }
        
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
        
        $shippingMethods = ShippingMethod::where('active', true)->orderBy('price')->get();
        $shippingDefault = $shippingMethods->first();

        return view('commandes.validation', compact('produits', 'total', 'shippingMethods', 'shippingDefault'));
    }
    
    /**
     * Confirme et enregistre la commande
     */
    public function confirmer(Request $request)
    {
        $request->validate([
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:100',
            'code_postal' => 'required|string|max:10',
            'telephone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
        ], [
            'adresse.required' => 'L\'adresse de livraison est obligatoire',
            'ville.required' => 'La ville est obligatoire',
            'code_postal.required' => 'Le code postal est obligatoire',
            'telephone.required' => 'Le téléphone est obligatoire',
        ]);
        
        $panier = session('panier', []);
        
        if (empty($panier)) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide');
        }
        
        try {
            DB::beginTransaction();
            $shippingMethod = ShippingMethod::where('active', true)->findOrFail($request->shipping_method_id);
            
            // Calculer le total
            $subTotal = 0;
            foreach ($panier as $id => $item) {
                $produit = Produit::find($id);
                if ($produit) {
                    $prix = $produit->en_promotion && $produit->prix_promo ? $produit->prix_promo : $produit->prix;
                    $subTotal += $prix * $item['quantite'];
                }
            }
            $shippingTotal = (float) $shippingMethod->price;
            $total = $subTotal + $shippingTotal;
            
            // Créer la commande
            $commande = Commande::create([
                'user_id' => auth()->id(),
                'shipping_method_id' => $shippingMethod->id,
                'numero_commande' => 'CMD-' . strtoupper(Str::random(8)),
                'total' => $total,
                'shipping_total' => $shippingTotal,
                'sub_total' => $subTotal,
                'statut' => 'en_attente',
                'payment_status' => 'pending',
                'payment_method' => 'paypal',
                'adresse_livraison' => $request->adresse,
                'ville_livraison' => $request->ville,
                'code_postal_livraison' => $request->code_postal,
                'telephone_livraison' => $request->telephone,
                'notes' => $request->notes,
            ]);
            
            // Créer les détails de commande et décrémenter le stock
            foreach ($panier as $id => $item) {
                $produit = Produit::find($id);
                if ($produit) {
                    // Vérifier le stock
                    if ($produit->stock < $item['quantite']) {
                        DB::rollBack();
                        return back()->with('error', 'Stock insuffisant pour ' . $produit->nom);
                    }
                    
                    $prix = $produit->en_promotion && $produit->prix_promo ? $produit->prix_promo : $produit->prix;
                    
                    // Créer le détail
                    DetailCommande::create([
                        'commande_id' => $commande->id,
                        'produit_id' => $produit->id,
                        'quantite' => $item['quantite'],
                        'prix_unitaire' => $prix,
                        'sous_total' => $prix * $item['quantite'],
                    ]);
                    
                    // Décrémenter le stock
                    $produit->decrement('stock', $item['quantite']);

                    InventoryMovement::create([
                        'produit_id' => $produit->id,
                        'type' => 'out',
                        'quantity' => $item['quantite'],
                        'reason' => 'order_placed',
                        'commande_id' => $commande->id,
                    ]);
                }
            }

            Payment::create([
                'commande_id' => $commande->id,
                'provider' => 'paypal',
                'amount' => $commande->total,
                'currency' => config('services.paypal.currency', 'USD'),
                'status' => 'pending',
            ]);
            
            DB::commit();
            
            // Vider le panier
            session()->forget('panier');

            Mail::to(auth()->user()->email)->send(new OrderPlacedMail($commande->fresh('details.produit')));
            
            return redirect()->route('commande.details', $commande->id)
                ->with('success', 'Commande passée avec succès ! N° ' . $commande->numero_commande);
            
        } catch (\Exception $e) {
            DB::rollBack();
            if (app()->environment('testing')) {
                throw $e;
            }
            return back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
    
    /**
     * Liste des commandes de l'utilisateur
     */
    public function mesCommandes()
    {
        $commandes = Commande::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('commandes.liste', compact('commandes'));
    }
    
    /**
     * Détails d'une commande
     */
    public function details($id)
    {
        $commande = Commande::where('user_id', auth()->id())
            ->with('details.produit')
            ->findOrFail($id);
        
        return view('commandes.details', compact('commande'));
    }
}
