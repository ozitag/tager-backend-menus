<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByAliasJob;
use OZiTAG\Tager\Backend\Menus\Jobs\SaveMenuItemsJob;
use OZiTAG\Tager\Backend\Menus\Requests\MenuItemsRequest;
use OZiTAG\Tager\Backend\Menus\Resources\MenuResource;

class UpdateItemsFeature extends Feature
{
    private $menu_alias;

    public function __construct($menuAlias)
    {
        $this->menu_alias = $menuAlias;
    }

    public function handle(MenuItemsRequest $request)
    {
        $model = $this->run(GetMenuByAliasJob::class, ['alias' => $this->menu_alias]);

        $model = $this->run(SaveMenuItemsJob::class, [
            'menu' => $model,
            'items' => $request->items
        ]);

        return new MenuResource($model);
    }
}
