<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;

class UpdateItemsFeature extends Feature
{
    private $menu_id;

    public function __construct($menuId)
    {
        $this->menu_id = $menuId;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->menu_id]);

        return new SuccessResource();
    }
}
