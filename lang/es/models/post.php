<?php

return [
    'module' => 'Post|Posts',
    'fillable' => [
        'title' => 'Título',
        'content' => 'Contenido',
    ],
    'actions' => [
        'create' => 'Crear post',
        'edit' => 'Editar post',
        'destroy' => 'Eliminar post',
    ]
];
