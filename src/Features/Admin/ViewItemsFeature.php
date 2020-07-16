<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuItemsJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuItemsTreeJob;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;

class ViewItemsFeature extends Feature
{
    private $menu_id;

    public function __construct($menuId)
    {
        $this->menu_id = $menuId;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->menu_id]);

        $items = $this->run(GetMenuItemsTreeJob::class, ['menu' => $model]);

        return new JsonResource($items);
    }
}
