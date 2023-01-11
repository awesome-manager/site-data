<?php

namespace App\Http\Controllers\Pages\Projects;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pages\Projects\ProjectsResource;
use Awesome\Foundation\Traits\Arrays\Arrayable;
use Awesome\Foundation\Traits\Requests\Decoding;
use AwesomeManager\ProjectService\Client\Facades\ProjectClient;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use Arrayable, Decoding;

    protected string $code = 'projects';
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

        $statuses = $this->findStatuses($this->pluckUniqueColumn($projects, 'status_id'));

        $groups = $this->findGroups($this->pluckUniqueColumn($projects, 'group_id'));

        $customers = $this->findCustomers($this->pluckUniqueColumn($projects, 'customer_id'));

        return response()->jsonResponse(new ProjectsResource(
            collect(compact('projects', 'statuses', 'groups', 'customers'))
        ));
    }

    private function findProjects(array $ids = [], bool $activeOnly = true)
    {
        return $this->decode(ProjectClient::projects($ids, $activeOnly)->send(), 'projects', []);
    }

    private function findStatuses(array $ids = [])
    {
        return $this->decode(ProjectClient::statuses(['ids' => $ids])->send(), 'statuses', []);
    }

    private function findGroups(array $ids = [])
    {
        return $this->decode(ProjectClient::groups(['ids' => $ids])->send(), 'groups', []);
    }

    private function findCustomers(array $ids = [])
    {
        return $this->decode(ProjectClient::customers(['ids' => $ids])->send(), 'customers', []);
    }
}
