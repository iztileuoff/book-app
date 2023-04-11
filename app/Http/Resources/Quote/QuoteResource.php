<?php

namespace App\Http\Resources\Quote;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'author' => $this->author,
            'text' => $this->text,
        ];
    }
}
