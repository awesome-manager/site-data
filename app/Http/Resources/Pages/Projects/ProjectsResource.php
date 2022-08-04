<?php

namespace App\Http\Resources\Pages\Projects;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectsResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'projects' => collect($this->resource->get('projects'))->map(function ($project) {
                return [
                    'id' => $this->string($project['id']),
                    'type' => $this->string($project['type']),
                    'budget' => $this->int($project['budget']),
                    'title' => $this->string($project['title']),
                    'comment' => $this->string($project['comment']),
                    'group_id' => $this->string($project['group_id']),
                    'status_id' => $this->string($project['status_id']),
                    'average_rate' => $this->int($project['average_rate']),
                    'customer_id' => $this->string($project['customer_id']),
                    'expected_profitability' => $this->int($project['expected_profitability'])
                ];
            }),
            'statuses' => collect($this->resource->get('statuses'))->map(function ($status) {
                return [
                    'id' => $this->string($status['id']),
                    'code' => $this->string($status['code']),
                    'title' => $this->string($status['title'])
                ];
            }),
            'groups' => collect($this->resource->get('groups'))->map(function ($group) {
                return [
                    'id' => $this->string($group['id']),
                    'code' => $this->string($group['code']),
                    'title' => $this->string($group['title'])
                ];
            }),
            'customers' => collect($this->resource->get('customers'))->map(function ($customer) {
                return [
                    'id' => $this->string($customer['id']),
                    'name' => $this->string($customer['name']),
                    'surname' => $this->string($customer['surname'])
                ];
            }),
        ];
    }
}
