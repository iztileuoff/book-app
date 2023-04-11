<?php

namespace App\Http\Resources\Quote;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QuoteCollection extends ResourceCollection
{
    public $collects = QuoteItemResource::class;
    
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'total' => $this->total(),
        ];
    }
}
