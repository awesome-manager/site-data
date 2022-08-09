<?php

namespace App\Http\Controllers\Pages\Projects;

use App\Http\Resources\Pages\Projects\GanttResource;

class GanttController extends AbstractProjectController
{
    public function data()
    {
        $projects = $this->findProjects();

        $this->abortIf(empty($projects));

        $groups = $this->findGroups(array_unique(array_column($projects, 'group_id')));

        return response()->jsonResponse(new GanttResource(
            collect(compact('projects', 'groups'))
        ));
    }
}
