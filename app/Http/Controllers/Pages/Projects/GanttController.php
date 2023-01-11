<?php

namespace App\Http\Controllers\Pages\Projects;

use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Arrays\Arrayable;
use Awesome\Foundation\Traits\Requests\Decoding;
use App\Http\Resources\Pages\Projects\GanttResource;
use AwesomeManager\ProjectService\Client\Facades\ProjectClient;
use Illuminate\Support\Facades\Auth;

class GanttController extends Controller
{
    use Arrayable, Decoding;

    protected string $code = 'gantt';
    protected array $filterEntities = ['project'];

    public function data()
    {
        if (!empty($this->filters['project'])) {
            $availableProjects = $this->filters['project'];
        } else {
            $this->abortIf(!Auth::user()->isAdmin());

            $availableProjects = [];
        }

        $projects = $this->findProjects($availableProjects, !Auth::user()->isAdmin());

        $this->abortIf(empty($projects));

        $groups = $this->findGroups($this->pluckUniqueColumn($projects, 'group_id'));

        return response()->jsonResponse(new GanttResource(
            collect(compact('projects', 'groups'))
        ));
    }

    private function findProjects(array $ids = [], bool $activeOnly = true)
    {
        return $this->decode(ProjectClient::projects($ids, $activeOnly)->send(), 'projects', []);
    }

    private function findGroups(array $ids = [])
    {
        return $this->decode(ProjectClient::groups(['ids' => $ids])->send(), 'groups', []);
    }
}
