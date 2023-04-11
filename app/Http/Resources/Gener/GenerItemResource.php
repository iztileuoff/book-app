<?php

namespace App\Http\Resources\Gener;

use Illuminate\Http\Resources\Json\JsonResource;

class GenerItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
