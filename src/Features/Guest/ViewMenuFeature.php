<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Guest;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByAliasJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuItemsTreeJob;

class ViewMenuFeature extends Feature
{
    protected string $alias;

    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByAliasJob::class, ['alias' => $this->alias]);

        $items = $this->run(GetMenuItemsTreeJob::class, [
            'menu' => $model,
            'replaceVariables' => true
        ]);

        return new JsonResource($items);
    }
}
