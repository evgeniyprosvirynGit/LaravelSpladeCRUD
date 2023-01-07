<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     * @test
     *
     * @return void
     */
    public function product_returns_successful_response()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }
}
