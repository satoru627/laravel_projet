<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@shop.test'], [
            'nom' => 'Admin',
            'prenom' => 'Root',
            'email' => 'admin@shop.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::factory(10)->create();

        $categories = collect([
            ['nom' => 'Electronics', 'description' => 'Devices and accessories'],
            ['nom' => 'Fashion', 'description' => 'Clothing and trends'],
            ['nom' => 'Home', 'description' => 'Home and kitchen'],
        ])->map(fn (array $item) => Categorie::firstOrCreate(['nom' => $item['nom']], $item + ['actif' => true]));

        foreach ($categories as $category) {
            Produit::factory()->count(8)->create(['categorie_id' => $category->id]);
        }

        ShippingMethod::firstOrCreate(['code' => 'standard'], [
            'name' => 'Standard shipping',
            'price' => 6.50,
            'estimated_days' => 5,
            'active' => true,
        ]);

        ShippingMethod::firstOrCreate(['code' => 'express'], [
            'name' => 'Express shipping',
            'price' => 14.90,
            'estimated_days' => 2,
            'active' => true,
        ]);
    }
}
