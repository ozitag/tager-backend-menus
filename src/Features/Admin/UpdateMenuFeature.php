<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\HttpCache\HttpCache;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByAliasJob;
use OZiTAG\Tager\Backend\Menus\Jobs\SaveMenuItemsJob;
use OZiTAG\Tager\Backend\Menus\Requests\MenuItemsRequest;
use OZiTAG\Tager\Backend\Menus\Resources\MenuResource;

class UpdateMenuFeature extends Feature
{
    private string $alias;

    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    public function handle(MenuItemsRequest $request, HttpCache $httpCache)
    {
        $this->run(GetMenuByAliasJob::class, [
            'alias' => $this->alias
        ]);

        $this->run(SaveMenuItemsJob::class, [
            'alias' => $this->alias,
            'items' => $request->items
        ]);

        $httpCache->clear('tager/menus');

        return new SuccessResource();
    }
}
