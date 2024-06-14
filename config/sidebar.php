<?php

return [
    [
        'title' => 'Beranda',
        'icon' => 'home',
        'route-name' => 'home',
        'is-active' => 'home',
        'description' => 'Untuk melihat ringkasan aplikasi.',
        'roles' => ['admin', 'user'],
    ],

    [
        'title' => 'Berkas Mahasiswa',
        'description' => 'Menampilkan berkas mahasiswa.',
        'icon' => 'newspaper',
        'route-name' => 'berkas.proposal.index',
        'is-active' => 'berkas*',
        'roles' => ['admin', 'user'],
        'sub-menus' => [
            [
                'title' => 'Proposal',
                'description' => 'Melihat data proposal mahasiswa.',
                'route-name' => 'berkas.proposal.index',
                'is-active' => 'berkas.proposal*',
            ],
            [
                'title' => 'Hasil',
                'description' => 'Melihat data berkas hasil mahasiswa.',
                'route-name' => 'berkas.hasil.index',
                'is-active' => 'berkas.hasil*',
            ],
            [
                'title' => 'Tutup',
                'description' => 'Melihat data berkas tutp mahasiswa.',
                'route-name' => 'berkas.tutup.index',
                'is-active' => 'berkas.tutup*',
            ],
        ],
    ],

    [
        'title' => 'Revisi Berkas',
        'description' => 'Menampilkan data revisi berkas mahasiswa.',
        'icon' => 'file-contract',
        'route-name' => 'revision.proposal.index',
        'is-active' => 'revision*',
        'roles' => ['admin', 'user'],
        'sub-menus' => [
            [
                'title' => 'Proposal',
                'description' => 'Melihat data revisi proposal mahasiswa.',
                'route-name' => 'revision.proposal.index',
                'is-active' => 'revision.proposal*',
            ],
            [
                'title' => 'Hasil',
                'description' => 'Melihat data revisi berkas hasil mahasiswa.',
                'route-name' => 'revision.hasil.index',
                'is-active' => 'revision.hasil*',
            ],
            [
                'title' => 'Tutup',
                'description' => 'Melihat data revisi berkas tutp mahasiswa.',
                'route-name' => 'revision.tutup.index',
                'is-active' => 'revision.tutup*',
            ],
        ],
    ],

    [
        'title' => 'Mahasiswa',
        'icon' => 'graduation-cap',
        'route-name' => 'mahasiswa.index',
        'is-active' => 'mahasiswa*',
        'description' => 'Untuk kelola data mahasiswa.',
        'roles' => ['admin'],
    ],

    [
        'title' => 'Pengguna',
        'icon' => 'user',
        'route-name' => 'pengguna.index',
        'is-active' => 'pengguna*',
        'description' => 'Untuk kelola data pengguna aplikasi.',
        'roles' => ['admin'],
    ],

    [
        'title' => 'Pengaturan',
        'description' => 'Menampilkan pengaturan aplikasi.',
        'icon' => 'cog',
        'route-name' => 'setting.profile.index',
        'is-active' => 'setting*',
        'roles' => ['admin', 'user'],
        'sub-menus' => [
            [
                'title' => 'Profil',
                'description' => 'Melihat pengaturan profil.',
                'route-name' => 'setting.profile.index',
                'is-active' => 'setting.profile*',
            ],
            [
                'title' => 'Akun',
                'description' => 'Melihat pengaturan akun.',
                'route-name' => 'setting.account.index',
                'is-active' => 'setting.account*',
            ],
        ],
    ],
];
