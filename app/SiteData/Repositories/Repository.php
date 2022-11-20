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

    public function SitePage(): Repositories\SitePageRepository
    {
        return app(Repositories\SitePageRepository::class);
    }
}
