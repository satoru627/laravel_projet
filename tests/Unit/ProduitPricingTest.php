<?php

namespace Tests\Unit;

use App\Models\Produit;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProduitPricingTest extends TestCase
{
    #[Test]
    public function it_returns_promo_price_when_product_is_on_promotion(): void
    {
        $produit = new Produit([
            'prix' => 100,
            'prix_promo' => 75,
            'en_promotion' => true,
        ]);

        $this->assertSame('75.00', $produit->prix_effectif);
    }
}
