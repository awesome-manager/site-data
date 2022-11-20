<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public string $code;

    protected function abortIf(bool $boolean, int $code = 404, string $message = '', array $headers = [])
    {
        abort_if($boolean, $code, $message, $headers);
    }
}
