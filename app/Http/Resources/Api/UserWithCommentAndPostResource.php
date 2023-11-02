<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserWithCommentAndPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'fullName'  => $this->full_name,
            'email'     => $this->email,
            'comments'  => CommentResource::collection($this->comments),
            'posts'  => PostResource::collection($this->posts),
        ];
    }
}
