<?php

return [
    'roles' => [
        'admin',
        'user',
    ],

    'program_studi' => [
        'SI' => 'Sistem Informasi',
        'TI' => 'Teknik Informatika',
    ],

    'status_file' => [
        'pending',
        'approve',
        'revision',
        'revised',
    ],

    'name_file' => [
        'proposal' => [
            'lembar persetujuan proposal',
            'surat keterangan administrasi pembayaran dari bauk (proposal)',
            'lembar konsultasi pembimbing 1',
            'lembar konsultasi pembimbing 2',
            'kartu rencana studi (KRS)',
            'lembar acc seminar proposal (SCREEN SHOOT DI SIAKAD)',
            'file proposal yang sudah di acc pembimbing'
        ],

        'hasil' => [
            'lembar persetujuan ujian hasil',
            'surat keterangan administrasi pembayaran dari bauk (hasil)',
            'lembar konsultasi -pembimbing 1 (hasil)',
            'lembar konsultasi -pembimbing 2 (hasil)',
            'KARTU RENCANA STUDI (KRS) (hasil)',
            'LEMBAR ACC UJIAN HASIL (SCREENSHOOT DI SIAKAD) (hasil)',
        ],

        'tutup' => [
            'lembar persetujuan ujian tutup',
            'surat keterangan administrasi pembayaran dari bauk (tutup)',
            'lembar konsultasi -pembimbing 1 (tutup)',
            'lembar konsultasi -pembimbing 2 (tutup)',
            'KARTU RENCANA STUDI (KRS) (tutup)',
            'LEMBAR ACC UJIAN HASIL (SCREENSHOOT DI SIAKAD) (tutup)',
        ],
    ],

    'category_document' => [
        'proposal',
        'hasil',
        'tutup',
    ],
];
