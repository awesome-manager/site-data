<?php

namespace App\Traits\Response;

use Illuminate\Http\{JsonResponse, Request, Response};

trait Responding
{
     public function passError(
         Response $response,
         string $resourceClass,
         ?Request $request = null,
         $default = ['success' => false]
     ): JsonResponse|Response
     {
         $data = json_decode($response->getContent(), true);

         if (empty($data['content'])) {
             return response()->jsonResponse($default);
         }

         if ($data['error'] !== 0) {
             return response($data);
         }

         return response()->jsonResponse((new $resourceClass($data['content']))->toArray($request));
     }
}
