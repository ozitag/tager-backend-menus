<?php

namespace OZiTAG\Tager\Backend\Menus\Resources;

use OZiTAG\Tager\Backend\Core\Resources\JsonResource;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;

class AdminMenuItemResource extends JsonResource
{
    protected array $children;

    public function __construct(TagerMenuItem $model, array $children = [])
    {
        parent::__construct($model);

        $this->children = $children;
    }

    public function getData()
    {
        /** @var TagerMenuItem $model */
        $model = $this->resource;

        return [
            'id' => $model->id,
            'label' => $model->label,
            'link' => $model->link,
            'isNewTab' => $model->is_new_tab ? true : false,
            'children' => array_map(function (TagerMenuItem $item) {
                return new AdminMenuItemResource($item['model'], $item['children']);
            }, $this->children)
        ];
    }
}
