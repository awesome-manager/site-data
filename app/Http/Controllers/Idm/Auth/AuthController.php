<?php

namespace App\Http\Controllers\Idm\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Idm\Auth\{LoginRequest, RefreshTokenRequest};
use App\Traits\Response\Responding;
use Awesome\Connector\Contracts\Status;
use AwesomeManager\IdmData\Client\Facades\IdmClient;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use Responding;

    public function login(LoginRequest $request)
    {
        $response = IdmClient::login(
            $request->input('username'),
            $request->input('password')
        )->send();

        return response()->jsonResponse($response->decode());
    }

    public function logout()
    {
        return $this->passUnchanged(IdmClient::logout()->send());
    }

    public function user()
    {
        return response()->jsonResponse(Auth::user());
    }

    public function refresh(RefreshTokenRequest $request)
    {
        $response = IdmClient::refreshAccessToken($request->get('refresh_token'));

        if (!empty($decode = $response->decode()) && !empty($decode['access_token'])) {
            return response()->jsonResponse($decode);
        }

        return response('Unauthorized.', Status::UNAUTHORIZED);
    }
}
