<?php

namespace App\SiteData\Repositories;

use App\SiteData\Contracts\Repositories\MenuItemRepository as RepositoryContract;
use Awesome\Foundation\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;

class MenuItemRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->getModel()->newQuery()
            ->select('id', 'title', 'site_page_id', 'icon')
            ->with('sitePage:id,title,link')
            ->where('is_active', true)
            ->whereHas('sitePage')
            ->orderByDesc('sort')
            ->get();
    }

    public function findBySitePageIds(array $ids): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->getModel()->newQuery()
            ->select('id', 'title', 'site_page_id', 'icon')
            ->where('is_active', true)
            ->whereIn('site_page_id', $ids)
            ->orderByDesc('sort')
            ->get();
    }
}
