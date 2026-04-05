<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    public function definition(): array
    {
        $price = fake()->randomFloat(2, 10, 300);
        $onPromo = fake()->boolean(20);

        return [
            'nom' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'prix' => $price,
            'prix_promo' => $onPromo ? $price * 0.85 : null,
            'stock' => fake()->numberBetween(0, 100),
            'image_principale' => 'https://via.placeholder.com/600x600?text=Product',
            'images_supplementaires' => null,
            'en_promotion' => $onPromo,
            'en_vedette' => fake()->boolean(15),
            'actif' => true,
        ];
    }
}
