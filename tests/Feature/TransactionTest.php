<?php

namespace Tests\Feature;

use App\Account;
use App\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware, WithFaker;

    /** @test
     * Creating new transaction from user's perspective
     * For this purpose we create 2 test accounts only
     * @return void
     */
    public function new_transaction_data_validation()
    {
        $accounts = Account::factory()->count(2)->create();

        // User One wants to have some transactions
        $id = $accounts[0]['id'];
        $response = $this->post('api/accounts/'. $id . '/transactions', $this->validData($accounts));

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'new_balance' => Account::find($id)->balance,
            ])->assertJsonStructure([
                'status',
                'model',
                'new_balance'
            ]);
        $this->assertCount(1, Transaction::all());
    }

    /** @test
     * New Transaction | Wrong destination
     * @return void
     */
    public function NT_wrong_to_id()
    {
        $accounts = Account::factory()->count(2)->create();

        // User One wants to have some transactions
        $id = $accounts[0]['id'];
        $new_data = array_merge($this->validData($accounts), ['to_id' => null]);
        $response = $this->post('api/accounts/'. $id . '/transactions', $new_data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => false,
//              'errors' => ["The to id field is required."]
//              'errors' => ["The to id must be an integer."]
//              'errors' => ["The to id must be at least 0."]
//              'errors' => ["You cannot have transaction with yourself!"]
//              'errors' => ["Destination Account has not been found!"]
            ])->assertJsonStructure([
                'status',
                'errors'
            ]);
        $this->assertCount(0, Transaction::all());
    }

    /** @test
     * New Transaction | Wrong amount
     * @return void
     */
    public function NT_wrong_amount()
    {
        $accounts = Account::factory()->count(2)->create();

        // User One wants to have some transactions
        $id = $accounts[0]['id'];
        $new_data = array_merge($this->validData($accounts), ['amount' => ($accounts[0]['balance']+1)]);
        $response = $this->post('api/accounts/'. $id . '/transactions', $new_data);

        $response->assertStatus(200)
            ->assertJson([
                'status' => false,
//              'errors' => ["The amount field is required."]
//              'errors' => ["The amount must be a number."]
//              'errors' => ["The amount must be at least 0.01."]
//              'errors' => ["Sorry! you don't have enough money!"]\
            ])->assertJsonStructure([
                'status',
                'errors'
            ]);
        $this->assertCount(0, Transaction::all());
    }

    /**
     * A helper function for an array of valid data
     */
    private function validData($accounts)
    {
        return [
            'to_id' => $accounts[1]['id'],
            'amount' => 12,
            'details' => $this->faker->text(200),
        ];
    }
}
