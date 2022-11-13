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
            ]
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
