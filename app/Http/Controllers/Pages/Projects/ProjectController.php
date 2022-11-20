<?php

namespace App\Http\Controllers\Pages\Projects;

use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Arrays\Arrayable;
use Awesome\Foundation\Traits\Requests\Decoding;
use App\Http\Resources\Pages\Projects\ProjectsResource;
use AwesomeManager\ProjectService\Client\Facades\ProjectClient;

class ProjectController extends Controller
{
    use Arrayable, Decoding;

    public string $code = 'projects';

    public function data()
    {
        $projects = $this->findProjects();

        $this->abortIf(empty($projects));

        $statuses = $this->findStatuses($this->pluckUniqueColumn($projects, 'status_id'));

        $groups = $this->findGroups($this->pluckUniqueColumn($projects, 'group_id'));

        $customers = $this->findCustomers($this->pluckUniqueColumn($projects, 'customer_id'));

        return response()->jsonResponse(new ProjectsResource(
            collect(compact('projects', 'statuses', 'groups', 'customers'))
        ));
    }

    private function findProjects()
    {
        return $this->decode(ProjectClient::projects()->send(), 'projects', []);
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
