<?php

namespace App\Http\Requests\Idm\Auth;

use Awesome\Rest\Requests\AbstractFormRequest;

class LoginRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }
}
