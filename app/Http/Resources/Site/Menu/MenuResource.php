<?php

namespace App\Http\Resources\Site\Menu;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class MenuResource extends ResourceCollection
{
    use Resourceable;

    private Collection $menu;
    private Collection $pages;

    public function __construct($resource)
    {
        $this->menu = $resource->get('menu');
        $this->pages = $resource->get('pages')->keyBy('id');

        parent::__construct($resource);
    }

    public function toArray($request = null): array
    {
        return [
            'menu' => $this->menu->map(function ($menuItem) {
                return [
                    'id' => $this->string($menuItem->id),
                    'title' => $this->string(
                        $menuItem->title ?: $this->pages->get($menuItem->site_page_id)->title
                    ),
                    'link' => $this->string($this->pages->get($menuItem->site_page_id)->link),
                    'icon' => $this->string($menuItem->icon)
                ];
            })->all()
        ];
    }
}
