<?php

namespace App\SiteData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface SitePageRepository
{
    public function findByCode(string $code): ?Model;
}
