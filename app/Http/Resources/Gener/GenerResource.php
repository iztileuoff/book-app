<?php

namespace App\Http\Resources\Gener;

use Illuminate\Http\Resources\Json\JsonResource;

class GenerResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            // 'books' => $this->books,
        ];
    }
}
