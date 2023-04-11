<?php

namespace App\Http\Resources\Gener;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GenerCollection extends ResourceCollection
{
    public $collects = GenerItemResource::class;
    
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
