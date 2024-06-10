<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = [
            [
                'name' => 'Supriadi Bonang',
                'nim' => '2023990888373',
                'program_studi' => 'TI',
                'email' => 'supriadi.unitama@gmail.com',
                'phone' => '0899733827288',
                'address' => 'Jl Pettarani',
                'entry_year' => '2023',
            ],

            [
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
