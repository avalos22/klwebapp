<?php
// Sidebar Navegation
return [
    'links' => [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'permission' => 'dashboard',
            'icon' => '<i class="fas fa-home"></i>',  // Icono de FontAwesome
        ],
        [
            'label' => 'Users',
            'route' => 'users.index',
            'role' => 'admin',
            'icon' => '<i class="fas fa-users"></i>',  // Icono de FontAwesome
        ],
        [
            'label' => 'Reports',
            'route' => 'reports',
            'role' => 'coordinator',
            'icon' => '<i class="fas fa-chart-bar"></i>',  // Icono de FontAwesome
        ],
        [
            'label' => 'Directory',
            'route' => 'business-directory.index',
            'permission' => 'directory.view',
            'icon' => '<i class="fas fa-folder"></i>',  // Icono de FontAwesome
        ],
        [
            'label' => 'Catalog Data',
            'route' => 'catalog',
            'permission' => 'catalog',
            'icon' => '<i class="fas fa-archive"></i>',  // Icono de FontAwesome
        ],
    ]
];
