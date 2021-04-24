<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Guest;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Utils\TagerVariables;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByAliasJob;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuItemsTreeJob;
use OZiTAG\Tager\Backend\Menus\Resources\MenuItemResource;

class ViewMenuFeature extends Feature
{
    protected string $alias;

    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    public function handle(TagerVariables $tagerVariables)
    {
        $this->run(GetMenuByAliasJob::class, ['alias' => $this->alias]);

        $items = $this->run(GetMenuItemsTreeJob::class, [
            'alias' => $this->alias
        ]);

        $result = [];
        foreach ($items as $item) {
            $item['model']->label = $tagerVariables->processText($item['model']->label);
            $result[] = new MenuItemResource($item['model'], $item['children']);
        }

        return new JsonResource($result);
    }
}
