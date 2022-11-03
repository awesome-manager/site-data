<?php

namespace App\Http\Controllers\Idm\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Idm\Auth\LoginRequest;
use AwesomeManager\IdmData\Client\Facades\IdmClient;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $response = IdmClient::login(
            $request->input('username'),
            $request->input('password')
        )->send();

        return response()->jsonResponse($response->decode());
    }
}
