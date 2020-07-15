<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;

class CreateMenuItemFeature extends Feature
{
    private $menuId;

    public function __construct($menuId)
    {
        $this->menuId = $menuId;
    }

    public function handle()
    {
        return new JsonResource();
    }
}
