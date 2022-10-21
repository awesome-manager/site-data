<?php

namespace App\Http\Controllers\Pages\Projects;

use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Arrays\Arrayable;
use Awesome\Foundation\Traits\Requests\Decoding;
use App\Http\Resources\Pages\Projects\GanttResource;
use AwesomeManager\ProjectService\Client\Facades\ProjectClient;

class GanttController extends Controller
{
    use Arrayable, Decoding;

    public function data()
    {
        $projects = $this->findProjects();

        $this->abortIf(empty($projects));

        $groups = $this->findGroups($this->pluckUniqueColumn($projects, 'group_id'));

        return response()->jsonResponse(new GanttResource(
            collect(compact('projects', 'groups'))
        ));
    }

    private function findProjects()
    {
        return $this->decode(ProjectClient::projects()->send(), 'projects', []);
    }

    private function findGroups(array $ids = [])
    {
        return $this->decode(ProjectClient::groups(['ids' => $ids])->send(), 'groups', []);
    }
}
