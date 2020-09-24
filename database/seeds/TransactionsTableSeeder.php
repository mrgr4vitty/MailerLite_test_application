<?php

use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * We suppose these sample transactions has happened before current amount of balance.
     * So they are nothing but history now!
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            ['from_id' => 1, 'to_id' => 2, 'details' => 'sample transaction', 'amount' => 14],
            ['from_id' => 1, 'to_id' => 2, 'details' => 'sample transaction 2', 'amount' => 24],
            ['from_id' => 2, 'to_id' => 1, 'details' => 'sample transaction 3', 'amount' => 15],
        ];
        foreach($elements as $element){
            $item = new \App\Transaction();
            $item->from_id = $element['from_id'];
            $item->to_id = $element['to_id'];
            $item->details = $element['details'];
            $item->amount = $element['amount'];
            $item->save();
        }
    }
}
