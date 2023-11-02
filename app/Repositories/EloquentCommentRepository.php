<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;

class EloquentCommentRepository implements CommentRepositoryInterface
{
    /**
     * @param $attributes
     * @param $id
     * @return mixed
     */
    public function createOrUpdate($attributes, $id = null): mixed
    {
        return Comment::query()
            ->updateOrCreate(
                ['id' => $id],
                $attributes
            );
    }
}
