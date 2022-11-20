<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\SiteData\Contracts\Repositories;
use App\SiteData\Contracts\Repositories\Repository as RepositoryContract;

/**
 * @method static Repositories\MenuItemRepository menuItem()
 */
class Repository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return RepositoryContract::class;
    }
}
