<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'image' => !isset($this->image->url) ? env('APP_URL')."/storage/avatars/user.png" : env('APP_URL')."/storage/avatars/".$this->image->url,
        ];
    }
}
