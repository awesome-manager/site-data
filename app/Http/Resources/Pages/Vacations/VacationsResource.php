<?php

namespace App\Http\Resources\Pages\Vacations;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VacationsResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'vacations' => collect($this->resource->get('vacations'))->map(function ($vacation) {
                return [
                    'id' => $this->string($vacation['id']),
                    'started_at' => $this->string($vacation['started_at']),
                    'ended_at' => $this->string($vacation['ended_at']),
                    'employee_id' => $this->string($vacation['employee_id'])
                ];
            }),
            'employees' => collect($this->resource->get('employees'))->map(function ($employee) {
                return [
                    'id' => $this->string($employee['id']),
                    'name' => $this->string($employee['name']),
                    'surname' => $this->string($employee['surname']),
                ];
            })
        ];
    }
}
