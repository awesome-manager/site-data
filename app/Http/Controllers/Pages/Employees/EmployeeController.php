<?php

namespace App\Http\Controllers\Pages\Employees;

use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Requests\Decoding;
use Awesome\Foundation\Traits\Arrays\Arrayable;
use App\Http\Resources\Pages\Employees\EmployeesResource;
use AwesomeManager\TeamService\Client\Facades\TeamClient;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    use Arrayable, Decoding;

    protected string $code = 'employees';

    public function data()
    {
        $employees = $this->decode(TeamClient::employees(!Auth::user()->isAdmin())->send(), 'employees', []);

        $this->abortIf(empty($employees));

        $grades = $this->decode(
            TeamClient::grades($this->pluckUniqueColumn($employees, 'grade_id'))->send(), 'grades', []
        );

        $positions = $this->decode(
            TeamClient::positions(
                $this->pluckUniqueColumn($employees, 'position_id')
            )->send(), 'positions', []
        );

        return response()->jsonResponse((new EmployeesResource(compact('employees', 'grades', 'positions'))));
    }
}
