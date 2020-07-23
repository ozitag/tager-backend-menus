<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByAliasJob;
use OZiTAG\Tager\Backend\Menus\Resources\MenuResource;

class ViewMenuByAliasFeature extends Feature
{
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByAliasJob::class, ['alias' => $this->alias]);

        return new MenuResource($model);
    }
}
