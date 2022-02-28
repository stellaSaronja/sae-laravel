<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostingFull extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'like_count' => $this->like_count,
            'dislike_count' => $this->dislike_count,
            'like_ratio' => $this->like_ratio,
            'user' => new User($this->user),
        ];
    }
}
