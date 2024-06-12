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
        'icon' => 'newspaper',
        'route-name' => 'berkas.index',
        'is-active' => 'berkas*',
        'description' => 'Untuk kelola data berkas mahasiswa.',
        'roles' => ['admin'],
    ],

    [
        'title' => 'Revisi Berkas',
        'icon' => 'file-contract',
        'route-name' => 'revision.index',
        'is-active' => 'revision*',
        'description' => 'Untuk kelola data revisi  mahasiswa.',
        'roles' => ['admin'],
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
