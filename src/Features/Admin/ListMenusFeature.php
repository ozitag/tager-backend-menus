<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;
use OZiTAG\Tager\Backend\Menus\Resources\MenuResource;

class ListMenusFeature extends Feature
{
    public function handle(MenuRepository $repository)
    {
        return MenuResource::collection($repository->all());
    }
}
