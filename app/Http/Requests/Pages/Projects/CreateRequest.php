<?php

namespace App\Http\Requests\Pages\Projects;

use Awesome\Rest\Requests\AbstractFormRequest;

class CreateRequest extends AbstractFormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:100',
            'customer_id' => 'required|uuid',
            'group_id' => 'required|uuid',
            'type' => 'required|string',
            'status_id' => 'required|uuid',
            'started_at' => 'filled|date',
            'ended_at' => 'filled|date|after:started_at',
            'budget' => 'filled|int',
            'expected_profitability' => 'filled|int|max:100',
            'average_rate' => 'filled|int',
            'comment' => 'filled|string',
            'is_active' => 'filled|boolean',
        ];
    }
}
