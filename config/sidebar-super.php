<?php

return [
    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'menu' => [
        [
            'icon' => 'fa fa-th-large',
            'title' => 'Beranda',
            'url' => '/superadmin/dashboard',
        ],
        [
            'icon' => 'fa fa-calendar',
            'title' => 'Jadwal',
            'url' => '/superadmin/jadwal',
        ],
        [
            'icon' => 'fa fa-user',
            'title' => 'Data User',
            'url' => '/superadmin/users',
        ],
        [
            'icon' => 'fa fa-user-shield',
            'title' => 'Data Admin',
            'url' => '/superadmin/admin',
        ],
        [
            'icon' => 'fa fa-file-alt',
            'title' => 'Data Master',
            'url' => '#',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/superadmin/fasilitas',
                    'title' => 'Fasilitas',
                ],
                [
                    'url' => '/superadmin/instansi',
                    'title' => 'Instansi',
                ],
                [
                    'url' => '/superadmin/alat-pendukung',
                    'title' => 'Alat Pendukung',
                ],
                [
                    'url' => '/superadmin/blok-ruangan',
                    'title' => 'Blok Ruangan',
                ],
                // [
                //     'url' => '/superadmin/bidang-kegiatan',
                //     'title' => 'Bidang Kegiatan',
                // ],
            ],
        ],
        [
            'icon' => 'fa fa-folder',
            'title' => 'Data Permohonan',
            'url' => '/superadmin/history',
        ],
        // [
        //     'icon' => 'fa fa-print',
        //     'title' => 'Laporan',
        //     'url' => '',
        // ],
    ],
];
