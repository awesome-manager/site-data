<?php

namespace App\Http\Controllers\Site\Menu;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Site\Menu\MenuResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    private ?Model $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function data()
    {
        if (is_null($this->user)) {
            $menu = Repository::menuItem()->findAllActive();
        } else {
            $pages = Repository::sitePage()->findByCodes($this->user->getAccessPages());
            $menu = Repository::menuItem()->findBySitePageIds($pages->pluck('id')->all());
        }

        return response()->jsonResponse(
            (new MenuResource(collect([
                'menu' => $menu,
                'pages' => $pages ?? $menu->pluck('site_pages')
            ])))->toArray()
        );
    }
}
