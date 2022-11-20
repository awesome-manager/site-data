<?php

namespace App\SiteData\Repositories;

use App\SiteData\Contracts\Repositories\SitePageRepository as RepositoryContract;
use Awesome\Foundation\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class SitePageRepository extends AbstractRepository implements RepositoryContract
{
    public function getByCode(string $code): ?Model
    {
        return $this->getModel()->newQuery()
            ->select('id', 'title', 'code', 'link')
            ->where('code', $code)
            ->where('is_active', true)
            ->first();
    }

    public function findByCodes(array $codes): Collection
    {
        if (empty($codes)) {
            return $this->getCollection();
        }

        return $this->getModel()->newQuery()
            ->select('id', 'title', 'code', 'link')
            ->whereIn('code', $codes)
            ->where('is_active', true)
            ->get();
    }
}
