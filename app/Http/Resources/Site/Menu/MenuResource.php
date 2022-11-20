<?php

namespace App\Http\Resources\Site\Menu;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null): array
    {
        return [
            'menu' => $this->resource->map(function ($menuItem) {
                return [
                    'id' => $this->string($menuItem->id),
                    'title' => $this->string($menuItem->title ?: $menuItem->sitePage->title),
                    'link' => $this->string($menuItem->sitePage->link),
                    'icon' => $this->string($menuItem->icon)
                ];
            })->all()
        ];
    }
}
