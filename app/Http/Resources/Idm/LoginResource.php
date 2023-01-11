<?php

namespace App\Http\Resources\Idm;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'token_type' => $this->string($this->resource['token_type']),
            'expires_in' => $this->timestamp($this->resource['expires_in']),
            'access_token' => $this->string($this->resource['access_token']),
            'refresh_token' => $this->string($this->resource['refresh_token'])
        ];
    }
}
