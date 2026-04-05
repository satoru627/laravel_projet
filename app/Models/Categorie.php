<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'description',
        'image',
        'actif',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'actif' => 'boolean',
    ];

    /**
     * Relation avec les produits
     */
    public function produits()
    {
        return $this->hasMany(Produit::class);
    }

    /**
     * Obtenir le nombre de produits actifs
     */
    public function getProduitsActifsCountAttribute()
    {
        return $this->produits()->where('actif', true)->count();
    }
}
