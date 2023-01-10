<?php

namespace App\Http\Requests\Pages\Profile;

use Awesome\Rest\Requests\AbstractFormRequest;

class UpdateUserInfoRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'second_name' => 'nullable|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:100',
        ];
    }
}
