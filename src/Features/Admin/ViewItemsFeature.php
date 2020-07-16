<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByAliasJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuItemsJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuItemsTreeJob;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;

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
