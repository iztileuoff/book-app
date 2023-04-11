<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserItemResource::class;

    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'total' => $this->total()
        ];
    }
}
