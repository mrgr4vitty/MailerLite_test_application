<?php

namespace Database\Factories;

use App\Account;
use App\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'from_id' => Account::factory(),
            'to_id' => Account::factory(),
            'details' => $this->faker->text(150),
            'amount' => floatval(rand(1,20)),
        ];
    }
}
