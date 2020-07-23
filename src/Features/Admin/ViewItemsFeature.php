<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByAliasJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuItemsTreeJob;

class ViewItemsFeature extends Feature
{
    private $menu_alias;

    public function __construct($menuAlias)
    {
        $this->menu_alias = $menuAlias;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByAliasJob::class, ['alias' => $this->menu_alias]);

        $items = $this->run(GetMenuItemsTreeJob::class, ['menu' => $model]);

        return new JsonResource($items);
    }
}
