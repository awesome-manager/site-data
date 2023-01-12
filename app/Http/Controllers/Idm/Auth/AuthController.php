<?php

namespace App\Http\Controllers\Idm\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Idm\Auth\{LoginRequest, RefreshTokenRequest};
use App\Http\Resources\Idm\{LoginResource, LogoutResource, RefreshTokenResource, UserResource};
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

        if (!empty($decode = $response->decode()) && !empty($decode['access_token'])) {
            return response()->jsonResponse((new LoginResource($decode))->toArray());
        }

        return response()->jsonResponse($response->decode());
    }

    public function logout()
    {
        return $this->passError(
            IdmClient::logout()->send(),
            LogoutResource::class
        );
    }

    public function user()
    {
        return response()->jsonResponse((new UserResource(Auth::user()))->toArray());
    }

    public function refresh(RefreshTokenRequest $request)
    {
        $response = IdmClient::refreshAccessToken($request->get('refresh_token'));

        if (!empty($decode = $response->decode()) && !empty($decode['access_token'])) {
            return response()->jsonResponse((new RefreshTokenResource($decode))->toArray());
        }

        return response('Unauthorized.', Status::UNAUTHORIZED);
    }
}
