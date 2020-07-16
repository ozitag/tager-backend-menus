<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;
use OZiTAG\Tager\Backend\Menus\Jobs\SaveMenuItemsJob;
use OZiTAG\Tager\Backend\Menus\Requests\MenuItemsRequest;
use OZiTAG\Tager\Backend\Menus\Resources\MenuResource;

class UpdateItemsFeature extends Feature
{
    private $menu_id;

    public function __construct($menuId)
    {
        $this->menu_id = $menuId;
    }

    public function handle(MenuItemsRequest $request)
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->menu_id]);

        $model = $this->run(SaveMenuItemsJob::class, [
            'menu' => $model,
            'items' => $request->items
        ]);

        return new MenuResource($model);
    }
}
