<?php

namespace App\Http\Controllers\Pages\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\Profile\CreateUserImageRequest;
use App\Http\Resources\Pages\Profile\CreateUserImageResource;
use App\Traits\Response\Responding;
use Awesome\Foundation\Traits\Requests\Decoding;
use AwesomeManager\IdmData\Client\Facades\IdmClient;
use Illuminate\Support\Facades\Auth;

class UserImageController extends Controller
{
    use Decoding, Responding;

    public string $code = 'profile';

    public function createUserImage(CreateUserImageRequest $request)
    {
        return response()->jsonResponse(
            (new CreateUserImageResource(
                $this->decode(IdmClient::createUserImage(Auth::user()->id, $request->file('image'))->send())
            ))->toArray()
        );
    }

    public function deleteUserImage()
    {
        return $this->passUnchanged(IdmClient::deleteUserImage(Auth::user()->id)->send());
    }
}
