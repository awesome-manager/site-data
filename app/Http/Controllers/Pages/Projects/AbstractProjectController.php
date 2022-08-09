<?php

namespace App\Http\Controllers\Pages\Projects;

use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Requests\Decoding;
use AwesomeManager\ProjectService\Client\Facades\ProjectClient;

abstract class AbstractProjectController extends Controller
{
    use Decoding;

    protected function findProjects()
    {
        return $this->decode(ProjectClient::projects()->send(), 'projects', []);
    }

    protected function findStatuses(array $ids = [])
    {
        return $this->decode(ProjectClient::statuses(['ids' => $ids])->send(), 'statuses', []);
    }

    protected function findGroups(array $ids = [], $withAvailable = false)
    {
        return $this->decode(ProjectClient::groups(['ids' => $ids], $withAvailable)->send(), 'groups', []);
    }

    protected function findCustomers(array $ids = [], $withAvailable = false)
    {
        return $this->decode(ProjectClient::customers(['ids' => $ids], $withAvailable)->send(), 'customers', []);
    }
}
