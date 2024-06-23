<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'Bintang Admin',
                'email' => 'muhbintang650@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('bintang123'),
                'roles' => 'admin',
            ],
            [
                'username' => 'Fery Admin',
                'email' => 'feryfadulrahman1@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('fery123'),
                'roles' => 'admin',
            ],
            [
                'username' => 'Callu18',
                'email' => 'callustudio18@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('callu123'),
                'roles' => 'admin',
            ],
            [
                'username' => 'Habibdzikry',
                'email' => 'alhabib@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('habib123'),
                'roles' => 'admin',
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}

