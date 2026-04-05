<?php

namespace Tests\Feature;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CheckoutFlowTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_create_pending_order_from_checkout(): void
    {
        $user = User::factory()->create();
        $category = Categorie::create(['nom' => 'Test category', 'actif' => true]);
        $produit = Produit::create([
            'nom' => 'Test product',
            'description' => 'Desc',
            'prix' => 20,
            'stock' => 10,
            'categorie_id' => $category->id,
            'image_principale' => 'https://example.com/x.jpg',
            'actif' => true,
        ]);
        $shipping = ShippingMethod::create(['name' => 'Standard', 'code' => 'std', 'price' => 5, 'estimated_days' => 3, 'active' => true]);

        $response = $this->actingAs($user)
            ->withSession(['panier' => [$produit->id => ['quantite' => 1]]])
            ->post('/commande/confirmer', [
                'adresse' => '123 Main St',
                'ville' => 'Paris',
                'code_postal' => '75001',
                'telephone' => '0102030405',
                'shipping_method_id' => $shipping->id,
            ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('commandes', ['user_id' => $user->id, 'payment_status' => 'pending']);
    }
}
