<?php

namespace App\Http\Requests\Idm\Auth;

use Awesome\Rest\Requests\AbstractFormRequest;

class RefreshTokenRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'refresh_token' => 'required|string',
        ];
    }
}
