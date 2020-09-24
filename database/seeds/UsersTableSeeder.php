<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            ['name' => 'John', 'email' => 'John@test.com', 'password' => Hash::make('John_default')],
            ['name' => 'Peter', 'email' => 'Peter@test.com', 'password' => Hash::make('Peter_default')],
        ];
        foreach($elements as $element){
            $item = new \App\User();
            $item->name = $element['name'];
            $item->email = $element['email'];
            $item->password = $element['password'];
            $item->save();
        }
    }
}
