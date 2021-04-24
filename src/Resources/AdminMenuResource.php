<?php

namespace OZiTAG\Tager\Backend\Menus\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;
use OZiTAG\Tager\Backend\Menus\Structures\TagerMenu;

class AdminMenuResource extends JsonResource
{
    protected string $menuAlias;

    protected array $menuItems;

    public function __construct(string $menuAlias, TagerMenu $model, array $menuItems)
    {
        parent::__construct($model);

        $this->menuItems = $menuItems;

        $this->menuAlias = $menuAlias;
    }

    public function toArray($request)
    {
        /** @var TagerMenu $model */
        $model = $this->resource;

        return [
            'alias' => $this->menuAlias,
            'name' => $model->getName(),
            'supportsTree' => $model->supportsTree(),
            'items' => array_map(function ($item) {
                return new AdminMenuItemResource($item['model'], $item['children']);
            }, $this->menuItems)
        ];
    }
}
