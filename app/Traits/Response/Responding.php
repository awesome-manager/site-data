<?php

namespace App\Traits\Response;

use Illuminate\Http\Response;

trait Responding
{
     public function passUnchanged(Response $response, $default = ['success' => false])
     {
         $data = json_decode($response->getContent(), true);

         return empty($data['content']) ? response()->jsonResponse($default) : response($data);
     }
}
