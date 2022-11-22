<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Mylonas Papadopoulos',
                'email' => 'hellas@gmail.com',
                'password' => 'team3team3',
                'vat_number' => '11221122112'
            ],
            [
                'name' => 'Haruto Yoshikawa',
                'email' => 'sakura@gmail.com',
                'password' => 'team3team3',
                'vat_number' => '21221122112'
            ],
            [
                'name' => 'Zhang Wei',
                'email' => 'tiantian@gmail.com',
                'password' => 'team3team3',
                'vat_number' => '21521122112'
            ],
            [
                'name' => 'Emre Akbas',
                'email' => 'istanbulkebab@gmail.com',
                'password' => 'team3team3',
                'vat_number' => '31221122712'
            ],
            [
                'name' => 'Ciro Esposito',
                'email' => 'laveranapoletana@gmail.com',
                'password' => 'team3team3',
                'vat_number' => '21221122156'
            ],
            [
                'name' => 'Mario Hernandez',
                'email' => 'lacucaracha@gmail.com',
                'password' => 'team3team3',
                'vat_number' => '21441122112'
            ],
            [
                'name' => 'Daniel Dubois',
                'email' => 'leparisien@gmail.com',
                'password' => 'team3team3',
                'vat_number' => '21228822112'
            ],
        ];

        foreach ($users as $user) {
            User::query()->updateOrCreate([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'vat_number' => $user['vat_number']
            ]);
        }
    }
}
