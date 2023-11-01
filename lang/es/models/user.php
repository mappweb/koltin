<?php

return [
    'module' => 'Usuario|Usuarios',
    'fillable' => [
        'first_name' => 'Nombres',
        'last_name' => 'Apellidos',
    ],
    'actions' => [
        'create' => 'Crear usuario',
        'edit' => 'Editar usuario',
        'destroy' => 'Eliminar usuario',
    ]
];
