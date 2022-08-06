<?php

namespace App\Http\Resources\Pages\Projects;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GanttResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'projects' => collect($this->resource->get('projects'))->map(function ($project) {
                return [
                    'id' => $this->string($project['id']),
                    'type' => $this->string($project['type']),
                    'title' => $this->string($project['title']),
                    'group_id' => $this->string($project['group_id']),
                    'ended_at' => $this->string($project['ended_at']),
                    'started_at' => $this->string($project['started_at'])
                ];
            }),
            'groups' => collect($this->resource->get('groups'))->map(function ($group) {
                return [
                    'id' => $this->string($group['id']),
                    'title' => $this->string($group['title'])
                ];
            })
        ];
    }
}
