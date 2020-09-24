<?php

namespace Tests\Feature;

use App\Account;
use App\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test
     * Testing Main url: In fact testing database
     *
     * @return void
     */
    public function dashboard_url()
    {
        $response = $this->get('/')->assertStatus(200);
    }

    /** @test
     * Fetching account info | We also could use Seeders instead of Factories
     *
     * @return void
     */
    public function getting_account_info()
    {
        //$this->withoutExceptionHandling();
        $account = Account::factory()->create();

        $response = $this->get('api/accounts/'.$account->id);

        /* I dont need to assert model because the model retrieved from factory is a little
        * different from the model retrieved from the route, for example one attribute returned
        * by the factory is integer while the exact same attribute returned by the route is string
        * with same value of the integer. So only asserting the Json structure will be fine.
        */
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
//              'model' => $account->load('user')
            ])->assertJsonStructure([
                'status',
                'model'
            ]);
    }

    /** @test
     * Fetching transaction list of an account | We also could use Seeders instead of Factories
     *
     * @return void
     */
    public function getting_transactions_of_account()
    {
        // We use 5 accounts for testing, however we can create more or less
        $count_accounts = 5;
        $accounts = Account::factory()->count($count_accounts)->create();

        // Now we create 10 (double of No of accounts) random transactions
        for($i=0; $i < (($count_accounts*2)-1); ++$i){
            $numbers = $this->UniqueRandomNumbersWithinRange(0, ($count_accounts-1), 2);
            $from_id = $accounts[$numbers[0]]['id'];
            $to_id = $accounts[$numbers[1]]['id'];
            Transaction::factory()->create(['from_id' => $from_id, 'to_id' => $to_id]);
        }

        // Now we select a random account to test
        $id = $accounts[rand(0,($count_accounts-1))]['id'];
        $transactions = Transaction::where('from_id', $id)->orWhere('to_id', $id)->get();
        $response = $this->get('api/accounts/'. $id . '/transactions');

        // Here we test different things about response | As aformentioned we dont need to assert 'model' directly
        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
//              'model' => $transactions->load('from.user', 'to.user')
            ])->assertJsonCount(count($transactions), 'model')
            ->assertJsonStructure([
                'status',
                'model'
            ]);
    }

    /**
     * This is just a helper function
     */
    private function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
}
