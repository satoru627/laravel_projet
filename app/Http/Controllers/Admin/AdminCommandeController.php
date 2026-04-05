<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commande;
use App\Mail\OrderStatusUpdatedMail;
use Illuminate\Support\Facades\Mail;

class AdminCommandeController extends Controller
{
    /**
     * Affiche la liste des commandes
     */
    public function index(Request $request)
    {
        $query = Commande::with('user');
        
        // Filtre par statut
        if ($request->has('statut') && $request->statut) {
            $query->where('statut', $request->statut);
        }
        
        // Recherche par numéro de commande ou nom client
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('numero_commande', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', function($query) use ($request) {
                      $query->where('nom', 'like', '%' . $request->search . '%')
                            ->orWhere('prenom', 'like', '%' . $request->search . '%')
                            ->orWhere('email', 'like', '%' . $request->search . '%');
                  });
            });
        }
        
        $commandes = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.commandes.index', compact('commandes'));
    }

    /**
     * Affiche les détails d'une commande
     */
    public function show($id)
    {
        $commande = Commande::with(['user', 'details.produit'])
            ->findOrFail($id);
        
        return view('admin.commandes.show', compact('commande'));
    }

    /**
     * Met à jour le statut d'une commande
     */
    public function updateStatut(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        
        $validated = $request->validate([
            'statut' => 'required|in:en_attente,confirmee,en_preparation,expediee,livree,annulee,failed',
        ]);
        
        $commande->update([
            'statut' => $validated['statut'],
        ]);

        Mail::to($commande->user->email)->send(new OrderStatusUpdatedMail($commande->fresh()));
        
        return redirect()->route('admin.commandes.show', $id)
            ->with('success', 'Statut de la commande mis à jour !');
    }
    /**
     * Supprime une commande
     */
    public function destroy($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return redirect()->route('admin.commandes.index')->with('success', 'Commande supprimée avec succès !');
    }
}
