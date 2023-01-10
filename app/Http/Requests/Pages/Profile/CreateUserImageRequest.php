<?php

namespace App\Http\Requests\Pages\Profile;

use Awesome\Rest\Requests\AbstractFormRequest;

class CreateUserImageRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'image' => 'required|file'
        ];
    }
}
