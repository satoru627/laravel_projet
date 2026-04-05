<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse
     */
    protected $fillable = [
        'user_id',
        'shipping_method_id',
        'numero_commande',
        'total',
        'shipping_total',
        'sub_total',
        'statut',
        'payment_status',
        'payment_method',
        'paid_at',
        'adresse_livraison',
        'ville_livraison',
        'code_postal_livraison',
        'telephone_livraison',
        'notes',
    ];

    /**
     * Les attributs qui doivent être castés
     */
    protected $casts = [
        'total' => 'decimal:2',
        'shipping_total' => 'decimal:2',
        'sub_total' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les détails de commande
     */
    public function details()
    {
        return $this->hasMany(DetailCommande::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }

    /**
     * Retourne le badge de statut avec couleur
     */
    public function getStatutBadgeAttribute()
    {
        $badges = [
            'en_attente' => ['label' => 'En attente', 'color' => 'yellow'],
            'confirmee' => ['label' => 'Confirmée', 'color' => 'blue'],
            'en_preparation' => ['label' => 'En préparation', 'color' => 'purple'],
            'expediee' => ['label' => 'Expédiée', 'color' => 'indigo'],
            'livree' => ['label' => 'Livrée', 'color' => 'green'],
            'annulee' => ['label' => 'Annulée', 'color' => 'red'],
            'failed' => ['label' => 'Paiement échoué', 'color' => 'red'],
        ];

        return $badges[$this->statut] ?? ['label' => $this->statut, 'color' => 'gray'];
    }

    /**
     * Scope pour les commandes en attente
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    /**
     * Scope pour les commandes confirmées
     */
    public function scopeConfirmee($query)
    {
        return $query->where('statut', 'confirmee');
    }
}
