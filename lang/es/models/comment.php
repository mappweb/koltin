<?php

return [
    'module' => 'Comentario|Comentarios',
    'fillable' => [
        'content' => 'Contenido',
        'post' => 'Post',
    ],
    'actions' => [
        'create' => 'Crear comentario',
        'edit' => 'Editar comentario',
        'destroy' => 'Eliminar comentario',
        'postComment' => 'Publicar comentario',
    ]
];
