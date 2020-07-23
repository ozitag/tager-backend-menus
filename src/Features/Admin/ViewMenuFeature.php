<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;
use OZiTAG\Tager\Backend\Menus\Resources\MenuResource;

class ViewMenuFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->id]);

        return new MenuResource($model);
    }
}
