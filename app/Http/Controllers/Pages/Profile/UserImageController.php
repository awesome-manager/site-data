<?php

namespace App\Http\Controllers\Pages\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pages\Profile\CreateUserImageRequest;
use App\Http\Resources\Pages\Profile\{CreateUserImageResource, DeleteUserImageResource};
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
        return response()->jsonResponse(
            (new DeleteUserImageResource(
                $this->decode(IdmClient::deleteUserImage(Auth::user()->id)->send())
            ))->toArray()
        );
    }
}
