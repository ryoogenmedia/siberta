<?php

namespace Database\Seeders;

use App\Models\Berkas;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BerkasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $berkas = [
            [
                'mahasiswa_id' => '1',
                'type_document' => 'PDF',
                'name_file' => 'lembar persetujuan proposal',
                'status_file' => 'pending',
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'file' => 'berkas-mahasiswa/berkas1.pdf',
                'note_mahasiswa' => 'Assalamulaikum bapak dan ibu dosen, saya ingin menyerahkan lembar persetujuan proposal saya 🙏'
            ],
            [
                'mahasiswa_id' => '2',
                'type_document' => 'PDF',
                'name_file' => 'lembar persetujuan proposal',
                'status_file' => 'pending',
                'file' => 'berkas-mahasiswa/berkas2.pdf',
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'note_mahasiswa' => 'Assalamulaikum bapak dan ibu dosen, saya ingin menyerahkan lembar persetujuan proposal saya 🙏'
            ]
        ];

        foreach($berkas as $data){
            Berkas::create($data);
        }
    }
}
