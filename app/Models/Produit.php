<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse
     */
    protected $fillable = [
        'nom',
        'description',
        'prix',
        'prix_promo',
        'stock',
        'categorie_id',
        'image_principale',
        'images_supplementaires',
        'en_promotion',
        'en_vedette',
        'actif',
    ];

    /**
     * Les attributs qui doivent être castés
     */
    protected $casts = [
        'prix' => 'decimal:2',
        'prix_promo' => 'decimal:2',
        'images_supplementaires' => 'array',
        'en_promotion' => 'boolean',
        'en_vedette' => 'boolean',
        'actif' => 'boolean',
    ];

    /**
     * Relation avec la catégorie
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * Relation avec les détails de commande
     */
    public function detailsCommandes()
    {
        return $this->hasMany(DetailCommande::class);
    }

    /**
     * Scope pour les produits actifs
     */
    public function scopeActif($query)
    {
        return $query->where('actif', true);
    }

    /**
     * Scope pour les produits en promotion
     */
    public function scopeEnPromotion($query)
    {
        return $query->where('en_promotion', true);
    }

    /**
     * Scope pour les produits en vedette
     */
    public function scopeEnVedette($query)
    {
        return $query->where('en_vedette', true);
    }

    /**
     * Scope pour les produits en stock
     */
    public function scopeEnStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Retourne le prix effectif (promo si disponible)
     */
    public function getPrixEffectifAttribute()
    {
        if ($this->en_promotion && $this->prix_promo) {
            return $this->prix_promo;
        }
        return $this->prix;
    }

    /**
     * Retourne la réduction en pourcentage
     */
    public function getPourcentageReductionAttribute()
    {
        if ($this->en_promotion && $this->prix_promo) {
            return round((($this->prix - $this->prix_promo) / $this->prix) * 100);
        }
        return 0;
    }

    /**
     * Vérifie si le produit est disponible
     */
    public function isDisponible()
    {
        return $this->actif && $this->stock > 0;
    }
}
