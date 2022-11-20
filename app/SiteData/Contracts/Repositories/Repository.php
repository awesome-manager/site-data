<?php

namespace App\SiteData\Contracts\Repositories;

interface Repository
{
    public function menuItem(): MenuItemRepository;
}
