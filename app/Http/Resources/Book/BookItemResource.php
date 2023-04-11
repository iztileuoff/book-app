<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => !isset($this->image->url) ? null : env('APP_URL')."/storage/books/".$this->image->url,
            'author' => $this->author,
            'count' => $this->count,
            'gener_id' => $this->gener->id,
            'gener_name' => $this->gener->name,
        ];
    }
}
