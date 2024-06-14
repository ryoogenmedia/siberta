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
            // BERKAS PROPOSAL
            [
                'mahasiswa_id' => '1',
                'type_document' => 'PDF',
                'name_file' => 'lembar persetujuan proposal',
                'status_file' => 'pending',
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'file' => 'berkas-mahasiswa/berkas1.pdf',
                'note_mahasiswa' => 'Assalamulaikum bapak dan ibu dosen, saya ingin menyerahkan lembar persetujuan proposal saya 🙏',
                'category' => 'proposal'
            ],
            [
                'mahasiswa_id' => '2',
                'type_document' => 'PDF',
                'name_file' => 'lembar konsultasi pembimbing 1',
                'status_file' => 'pending',
                'file' => 'berkas-mahasiswa/berkas2.pdf',
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'note_mahasiswa' => 'Assalamulaikum bapak dan ibu dosen, saya ingin menyerahkan lembar persetujuan proposal saya 🙏',
                'category' => 'proposal',
            ],
            // BERKAS HASIL
            [
                'mahasiswa_id' => '1',
                'type_document' => 'PDF',
                'name_file' => 'lembar persetujuan ujian hasil',
                'status_file' => 'pending',
                'file' => 'berkas-mahasiswa/berkas2.pdf',
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'note_mahasiswa' => 'Assalamulaikum bapak dan ibu dosen, saya ingin menyerahkan lembar persetujuan proposal saya 🙏',
                'category' => 'hasil',
            ],
            [
                'mahasiswa_id' => '2',
                'type_document' => 'PDF',
                'name_file' => 'surat keterangan administrasi pembayaran dari bauk',
                'status_file' => 'pending',
                'file' => 'berkas-mahasiswa/berkas2.pdf',
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'note_mahasiswa' => 'Assalamulaikum bapak dan ibu dosen, saya ingin menyerahkan lembar persetujuan proposal saya 🙏',
                'category' => 'hasil',
            ],
            // BERKAS TUTUP
            [
                'mahasiswa_id' => '1',
                'type_document' => 'PDF',
                'name_file' => 'LEMBAR ACC UJIAN HASIL (SCREENSHOOT DI SIAKAD)',
                'status_file' => 'pending',
                'file' => 'berkas-mahasiswa/berkas2.pdf',
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'note_mahasiswa' => 'Assalamulaikum bapak dan ibu dosen, saya ingin menyerahkan lembar persetujuan proposal saya 🙏',
                'category' => 'tutup',
            ],
            [
                'mahasiswa_id' => '2',
                'type_document' => 'PDF',
                'name_file' => 'LEMBAR ACC UJIAN HASIL (SCREENSHOOT DI SIAKAD)',
                'status_file' => 'pending',
                'file' => 'berkas-mahasiswa/berkas2.pdf',
                'date_upload' => Carbon::now()->format('Y-m-d'),
                'time_upload' => Carbon::now()->format('H:i:s'),
                'note_mahasiswa' => 'Assalamulaikum bapak dan ibu dosen, saya ingin menyerahkan lembar persetujuan proposal saya 🙏',
                'category' => 'tutup',
            ],
        ];

        foreach($berkas as $data){
            Berkas::create($data);
        }
    }
}
