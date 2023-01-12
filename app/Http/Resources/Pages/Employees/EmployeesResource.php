<?php

namespace App\Http\Resources\Pages\Employees;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class EmployeesResource extends ResourceCollection
{
    use Resourceable;

    private Collection $employees;
    private Collection $grades;
    private Collection $positions;

    public function __construct($resource)
    {
        $this->employees = collect($resource['employees']);
        $this->grades = collect($resource['grades']);
        $this->positions = collect($resource['positions']);

        parent::__construct($resource);
    }

    public function toArray($request = null): array
    {
        return [
            'employees' => $this->employees->map(fn (array $employee) => $this->prepareEmployee($employee)),
            'grades' => $this->grades->map(fn (array $grade) => $this->prepareGrade($grade)),
            'positions' => $this->positions->map(fn (array $position) => $this->preparePosition($position))
        ];
    }

    private function prepareEmployee(array $employee): array
    {
        return [
            'id' => $this->string($employee['id']),
            'name' => $this->string($employee['name']),
            'surname' => $this->string($employee['surname']),
            'employment_at' => $this->timestamp($employee['employment_at']),
            'probation' => $this->timestamp($employee['probation']),
            'grade_id' => $this->string($employee['grade_id']),
            'position_id' => $this->string($employee['position_id']),
        ];
    }

    private function prepareGrade(array $grade): array
    {
        return [
            'id' => $this->string($grade['id']),
            'title' => $this->string($grade['title']),
            'code' => $this->string($grade['code']),
        ];
    }

    private function preparePosition(array $position): array
    {
        return [
            'id' => $this->string($position['id']),
            'title' => $this->string($position['title']),
            'code' => $this->string($position['code']),
        ];
    }
}
