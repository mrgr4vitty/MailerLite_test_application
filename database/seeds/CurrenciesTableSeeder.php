<?php

namespace Database\Seeds;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            ['name' => 'US Dollar', 'abb' => 'USD', 'sign' => '$', 'main' => 1],
            ['name' => 'Euro', 'abb' => 'EUR', 'sign' => '€', 'main' => 0],
        ];
        foreach($elements as $element){
            $item = new \App\Currency();
            $item->name = $element['name'];
            $item->abb = $element['abb'];
            $item->sign = $element['sign'];
            $item->main = $element['main'];
            $item->save();
        }
    }
}
