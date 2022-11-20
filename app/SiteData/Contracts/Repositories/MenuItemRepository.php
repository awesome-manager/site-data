<?php

namespace App\SiteData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface MenuItemRepository
{
    public function findAllActive(): Collection;

    public function findBySitePageIds(array $ids): Collection;
}
