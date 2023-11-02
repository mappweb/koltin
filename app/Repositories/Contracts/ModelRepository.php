<?php

namespace App\Repositories\Contracts;

interface ModelRepository
{
    /**
     * @param $attributes
     * @param $id
     * @return mixed
     */
    public function createOrUpdate($attributes, $id = null): mixed;
}
