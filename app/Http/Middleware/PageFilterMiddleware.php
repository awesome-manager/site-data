<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageFilterMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if ($this->needFilter(Auth::user()->getAccessGroups($request->route()->controller->getCode()))) {
            $filters = [];

            foreach ($request->route()->controller->getFilterEntities() as $filterEntity) {
                $filters[$filterEntity] = Auth::user()->getFilters($filterEntity);
            }

            $request->route()->controller->setFilters($filters);
        }

        return $next($request);
    }

    private function needFilter(array $accessGroups): bool
    {
        return  $this->checkNeedFilterCount($accessGroups) === count($accessGroups);
    }

    private function checkNeedFilterCount(array $accessGroups): int
    {
        return count(array_filter(
            array_column($accessGroups, 'has_filter'), fn ($hasFilter) => $hasFilter === true
        ));
    }
}
