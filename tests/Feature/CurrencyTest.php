<?php

namespace Tests\Feature;

use App\Currency;
use Database\Seeds\CurrenciesTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CurrencyTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test
     * Testing the only method of getting currencies
     *
     * @return void
     */
    public function getting_currencies()
    {
        // We use seeding here
        $this->seed(CurrenciesTableSeeder::class);

        $response = $this->get('/api/currencies');

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'rates' => [1, 1.17],
            ])->assertJsonStructure([
                'status',
                'model',
                'rates'
            ]);
        $this->assertDatabaseCount('currencies', 2);
    }
}
