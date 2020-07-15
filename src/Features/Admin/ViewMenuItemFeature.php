<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;

class ViewMenuItemFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        return new JsonResource();
    }
}
