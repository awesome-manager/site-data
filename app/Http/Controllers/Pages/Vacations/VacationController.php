<?php

namespace App\Http\Controllers\Pages\Vacations;

use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Requests\Decoding;
use App\Http\Resources\Pages\Vacations\VacationsResource;
use AwesomeManager\TeamService\Client\Facades\TeamClient;

class VacationController extends Controller
{
    use Decoding;

    public function data()
    {
        $response = $this->decode(TeamClient::vacations()->send(), null, []);

        $this->abortIf(empty($response));

        return response()->jsonResponse((new VacationsResource($response)));
    }
}
