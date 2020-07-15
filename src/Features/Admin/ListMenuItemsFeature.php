<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;

class ListMenuItemsFeature extends Feature
{
    public function handle()
    {
        return new JsonResource();
    }
}
