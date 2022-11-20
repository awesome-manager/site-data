<?php

namespace App\SiteData\Repositories;

use App\SiteData\Contracts\Repositories;
use App\SiteData\Contracts\Repositories\Repository as RepositoryContract;

class Repository implements RepositoryContract
{
    public function menuItem(): Repositories\MenuItemRepository
    {
        return app(Repositories\MenuItemRepository::class);
    }
}
