<?php

use App\User;
use Illuminate\Database\Seeder;

class FirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "team3";
        $user->email = "team3@gmail.com";
        $user->password = Hash::make("team3team3");
        $user->vat_number = "11122233344";
        $user->save();
    }
}
