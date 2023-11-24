<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_store_product(): void
    {
        $product = Product::factory()->make()->toArray();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('product.store'), $product);

        // Assert that the response has a successful status code
        $response->assertStatus(302);

    }
}
