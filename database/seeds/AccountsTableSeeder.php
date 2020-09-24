<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * I really preferred to handle this at UsersTableSeeder but anyway here is fine too
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            ['user_id' => 1, 'balance' => 15000],
            ['user_id' => 2, 'balance' => 100000],
        ];
        foreach($elements as $element){
            $item = new \App\Account();
            $item->user_id = $element['user_id'];
            $item->balance = $element['balance'];
            $item->save();
        }
    }
}
