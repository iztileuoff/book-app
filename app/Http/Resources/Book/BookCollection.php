<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    public $collects = BookItemResource::class;

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'total' => $this->total()
        ];
    }
}
