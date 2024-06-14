<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akun1 = User::create([
            'username' => 'Supriadi Bonang',
            'email' => 'supriadi.unitama@gmail.com',
            'roles' => 'user',
            'email_verified_at' => now(),
            'password' => bcrypt("supriadi.unitama@gmail.com*user"),
        ]);

        $akun2 = User::create([
            'username' => 'Akbar Maulana',
            'email' => 'sakbar.unitama@gmail.com',
            'roles' => 'user',
            'email_verified_at' => now(),
            'password' => bcrypt("akbar.unitama@gmail.com*user"),
        ]);

        $mahasiswa = [
            [
                'user_id' => $akun1->id,
                'name' => 'Supriadi Bonang',
                'nim' => '2023990888373',
                'program_studi' => 'TI',
                'email' => 'supriadi.unitama@gmail.com',
                'phone' => '0899733827288',
                'address' => 'Jl Pettarani',
                'entry_year' => '2023',
            ],

            [
                'user_id' => $akun2->id,
                'name' => 'Akbar Maulana',
                'nim' => '2023990888344',
                'program_studi' => 'SI',
                'email' => 'akbar.unitama@gmail.com',
                'phone' => '0899733827272',
                'address' => 'Jl Bakung',
                'entry_year' => '2023',
            ]
        ];

        foreach($mahasiswa as $data){
            Mahasiswa::create($data);
        }
    }
}
