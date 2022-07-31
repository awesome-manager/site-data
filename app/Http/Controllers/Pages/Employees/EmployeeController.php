<?php

namespace App\Http\Controllers\Pages\Employees;

use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Decoding;
use App\Http\Resources\Pages\Employees\EmployeesResource;
use AwesomeManager\TeamService\Client\Facades\TeamClient;

class EmployeeController extends Controller
{
    use Decoding;

    public function data()
    {
        $response = $this->decode(TeamClient::employees()->send(), 'employees', []);

        $this->abortIf(empty($response));

        return response()->jsonResponse((new EmployeesResource($response)));
    }
}
