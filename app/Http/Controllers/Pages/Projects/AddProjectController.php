<?php

namespace App\Http\Controllers\Pages\Projects;

use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use App\Traits\Response\Responding;
use App\Http\Controllers\Controller;
use Awesome\Foundation\Traits\Arrays\Arrayable;
use Awesome\Foundation\Traits\Requests\Decoding;
use App\Http\Requests\Pages\Projects\CreateRequest;
use App\Http\Resources\Pages\Projects\AddProjectResource;
use AwesomeManager\ProjectService\Client\Facades\ProjectClient;

class AddProjectController extends Controller
{
    use Arrayable, Decoding, Responding;

    public string $code = 'add_project';

    public function data()
    {
        $statuses = $this->findStatuses();

        $this->abortIf(empty($statuses));

        $groups = $this->findGroups([], true);

        $this->abortIf(empty($groups['groups']) || empty($groups['available_customers']));

        $groupCustomers = $groups['available_customers'];

        $customers = $this->findCustomers(
            $this->pluckUniqueColumn($groupCustomers, 'customer_id')
        );

        $this->abortIf(empty($customers));

        $groups = Arr::keyBy($groups['groups'], 'id');
        $customers = Arr::keyBy($customers, 'id');

        [$availableGroups, $availableCustomers, $availableGroupCustomer] = $this->checkAvailable(
            $groupCustomers, $customers, $groups
        );

        return response()->jsonResponse(new AddProjectResource(
            collect([
                'statuses' => $statuses,
                'groups' => array_values($availableGroups),
                'group_customer' => $availableGroupCustomer,
                'customers' => array_values($availableCustomers)
            ])
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->passUnchanged($this->createProject($request->validated()));
    }

    private function findStatuses(array $ids = []): array
    {
        return $this->decode(ProjectClient::statuses(['ids' => $ids])->send(), 'statuses', []);
    }

    private function findGroups(array $ids = [], $withAvailable = false): array
    {
        return $this->decode(ProjectClient::groups(['ids' => $ids], $withAvailable)->send(), null, []);
    }

    private function findCustomers(array $ids = [], $withAvailable = false): array
    {
        return $this->decode(ProjectClient::customers(['ids' => $ids], $withAvailable)->send(), 'customers', []);
    }

    private function createProject(array $data): Response
    {
        return ProjectClient::createProject($data)->send();
    }

    private function checkAvailable(array $groupCustomers, array $customers, array $groups): array
    {
        $availableCustomers = $availableGroups = $availableGroupCustomer = [];

        foreach ($groupCustomers as $groupCustomer) {
            if (
                array_key_exists($groupCustomer['customer_id'], $customers) &&
                array_key_exists($groupCustomer['group_id'], $groups)
            ) {
                if (!array_key_exists($groupCustomer['customer_id'], $availableCustomers)) {
                    $availableCustomers[$groupCustomer['customer_id']] = $customers[$groupCustomer['customer_id']];
                }

                if (!array_key_exists($groupCustomer['group_id'], $availableGroups)) {
                    $availableGroups[$groupCustomer['group_id']] = $groups[$groupCustomer['group_id']];
                }
            } else {
                continue;
            }

            $availableGroupCustomer[] = $groupCustomer;
        }

        return [$availableGroups, $availableCustomers, $availableGroupCustomer];
    }
}
