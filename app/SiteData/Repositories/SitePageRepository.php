<?php

namespace App\SiteData\Repositories;

use App\SiteData\Contracts\Repositories\SitePageRepository as RepositoryContract;
use Awesome\Foundation\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class SitePageRepository extends AbstractRepository implements RepositoryContract
{
    public function findByCode(string $code): ?Model
    {
        return $this->getModel()->newQuery()
            ->select('id', 'title', 'code', 'link')
            ->where('code', $code)
            ->where('is_active', true)
            ->first();
    }
}
