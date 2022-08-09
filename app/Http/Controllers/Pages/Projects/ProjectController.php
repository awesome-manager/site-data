<?php

namespace App\Http\Controllers\Pages\Projects;

use App\Http\Resources\Pages\Projects\ProjectsResource;

class ProjectController extends AbstractProjectController
{
    public function data()
    {
        $projects = $this->findProjects();

        $this->abortIf(empty($projects));

        $statuses = $this->findStatuses(array_unique(array_column($projects, 'status_id')));

        $groups = $this->findGroups(array_unique(array_column($projects, 'group_id')));

        $customers = $this->findCustomers(array_unique(array_column($projects, 'customer_id')));

        return response()->jsonResponse(new ProjectsResource(
            collect(compact('projects', 'statuses', 'groups', 'customers'))
        ));
    }
}
