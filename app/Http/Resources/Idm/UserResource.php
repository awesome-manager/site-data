<?php

namespace App\Http\Resources\Idm;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'id' => $this->string($this->resource->id),
            'name' => $this->string($this->resource->name),
            'surname' => $this->string($this->resource->surname),
            'second_name' => $this->string($this->resource->second_name),
            'phone' => $this->string($this->resource->phone),
            'email' => $this->string($this->resource->email),
            'image' => $this->string($this->resource->image)
        ];
    }
}
