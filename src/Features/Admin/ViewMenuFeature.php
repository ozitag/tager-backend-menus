<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByAliasJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuItemsTreeJob;
use OZiTAG\Tager\Backend\Menus\Resources\AdminMenuResource;

class ViewMenuFeature extends Feature
{
    private string $alias;

    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByAliasJob::class, [
            'alias' => $this->alias
        ]);

        $items = $this->run(GetMenuItemsTreeJob::class, [
            'alias' => $this->alias
        ]);

        return new AdminMenuResource($this->alias, $model, $items);
    }
}
