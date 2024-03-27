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
            'url' => '/user/dashboard',
        ],
        [
            'icon' => 'fa fa-clock',
            'title' => 'Jadwal',
            'url' => '/user/jadwal',
        ],
        [
            'icon' => 'fa fa-folder',
            'title' => 'Permohonan',
            'url' => '#',
            'caret' => true,
            'sub_menu' => [
                [
                    'url' => '/user/buatPermohonan',
                    'title' => 'Buat Permohonan',
                ],
                [
                    'url' => '/user/historiPermohonan',
                    'title' => 'Histori Permohonan',
                ],
            ],
        ],
    ],
];
