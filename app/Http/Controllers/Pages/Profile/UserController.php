<?php

namespace App\Http\Controllers\Pages\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\Profile\UpdateUserInfoRequest;
use App\Traits\Response\Responding;
use AwesomeManager\IdmData\Client\Facades\IdmClient;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use Responding;

    public string $code = 'profile';

    public function updateUserInfo(UpdateUserInfoRequest $request)
    {
        return $this->passUnchanged(IdmClient::updateUser(
            Auth::user()->id,
            $request->validated()
        )->send());
    }
}
