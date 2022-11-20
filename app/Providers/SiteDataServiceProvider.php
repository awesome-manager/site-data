<?php

namespace App\Providers;

use App\Models;
use App\SiteData\{Contracts, Repositories};
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SiteDataServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    private function registerRepositories(): void
    {
        $this->app->bind(Contracts\Repositories\MenuItemRepository::class, function () {
            return new Repositories\MenuItemRepository(new Models\MenuItem());
        });

        $this->app->bind(Contracts\Repositories\SitePageRepository::class, function () {
            return new Repositories\SitePageRepository(new Models\SitePage());
        });
    }

    private function registerServices(): void
    {
        //
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return [
            Contracts\Repositories\MenuItemRepository::class,
            Contracts\Repositories\SitePageRepository::class,
        ];
    }
}
