<?php

namespace App\Http\Controllers\Site\Menu;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Site\Menu\MenuResource;

class MenuController extends Controller
{
    public function data()
    {
        return response()->jsonResponse(
            (new MenuResource(Repository::menuItem()->findAllActive()))->toArray()
        );
    }
}
