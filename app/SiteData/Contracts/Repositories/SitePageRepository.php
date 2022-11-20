<?php

namespace App\SiteData\Contracts\Repositories;

use Illuminate\Database\Eloquent\{Collection, Model};

interface SitePageRepository
{
    public function getByCode(string $code): ?Model;

    public function findByCodes(array $code): Collection;
}
