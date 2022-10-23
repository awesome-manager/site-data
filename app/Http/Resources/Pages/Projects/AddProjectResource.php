<?php

namespace App\Http\Resources\Pages\Projects;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AddProjectResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
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
            'group_customer' => collect($this->resource->get('group_customer'))->map(function ($groupCustomer) {
                return [
                    'id' => $groupCustomer['id'],
                    'group_id' => $groupCustomer['group_id'],
                    'customer_id' => $groupCustomer['customer_id']
                ];
            })
        ];
    }
}
