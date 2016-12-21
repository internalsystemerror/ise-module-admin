<?php
$dataTablesVersion = '1.10.13';

return [
    'resolver_configs' => [
        'collections' => [
            'css/admin.css' => [
                'css/datatables-bootstrap.css',
                'css/admin-global.css',
                'css/admin-queries.css',
            ],
            'js/admin.js'   => [
                'js/datatables.js',
                'js/datatables-bootstrap.js',
                'js/admin-global.js',
            ],
        ],
        'paths'       => [
            __DIR__ . '/../assets',
        ],
        'map'         => [
            /* IMAGES */
            'images/sort_asc.png'           => 'http://cdn.datatables.net/plug-ins/' . $dataTablesVersion . '/integration/bootstrap/images/sort_asc.png',
            'images/sort_asc_disabled.png'  => 'http://cdn.datatables.net/plug-ins/' . $dataTablesVersion . '/integration/bootstrap/images/sort_asc_disabled.png',
            'images/sort_both.png'          => 'http://cdn.datatables.net/plug-ins/' . $dataTablesVersion . '/integration/bootstrap/images/sort_both.png',
            'images/sort_desc.png'          => 'http://cdn.datatables.net/plug-ins/' . $dataTablesVersion . '/integration/bootstrap/images/sort_desc.png',
            'images/sort_desc_disabled.png' => 'http://cdn.datatables.net/plug-ins/' . $dataTablesVersion . '/integration/bootstrap/images/sort_desc_disabled.png',
            /* CSS */
            'css/datatables.css'            => 'http://cdn.datatables.net/' . $dataTablesVersion . '/css/jquery.dataTables.css',
            'css/datatables-bootstrap.css'  => 'http://cdn.datatables.net/plug-ins/' . $dataTablesVersion . '/integration/bootstrap/3/dataTables.bootstrap.css',
            'css/admin-global.css'          => __DIR__ . '/../assets/css/admin-global.css',
            'css/admin-queries.css'         => __DIR__ . '/../assets/css/admin-queries.css',
            'css/login.css'                 => __DIR__ . '/../assets/css/login.css',
            /* JS */
            'js/datatables.js'              => 'http://cdn.datatables.net/' . $dataTablesVersion . '/js/jquery.dataTables.js',
            'js/datatables-bootstrap.js'    => 'http://cdn.datatables.net/plug-ins/' . $dataTablesVersion . '/integration/bootstrap/3/dataTables.bootstrap.js',
            'js/admin-global.js'            => __DIR__ . '/../assets/js/admin-global.js',
            'js/login.js'                   => __DIR__ . '/../assets/js/login.js',
        ],
    ],
];
