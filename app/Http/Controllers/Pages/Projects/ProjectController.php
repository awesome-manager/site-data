<?php

namespace App\Http\Controllers\Pages\Projects;

use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Requests\Decoding;
use App\Http\Resources\Pages\Projects\ProjectsResource;
use AwesomeManager\ProjectService\Client\Facades\ProjectClient;

class ProjectController extends Controller
{
    use Decoding;

    public function data()
    {
        $response = $this->decode(ProjectClient::projects()->send(), null, []);

        $this->abortIf(empty($response));

        return response()->jsonResponse((new ProjectsResource($response)));
    }
}
