<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class EloquentPostRepository implements PostRepositoryInterface
{
    /**
     * @param $attributes
     * @param $id
     * @return mixed
     */
    public function createOrUpdate($attributes, $id = null): mixed
    {
        return Post::query()
            ->updateOrCreate(
                ['id' => $id],
                $attributes
            );
    }
}
