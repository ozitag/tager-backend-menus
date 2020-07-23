<?php

namespace OZiTAG\Tager\Backend\Menus\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;

class MenuItemsRepository extends EloquentRepository
{
    public function __construct(TagerMenuItem $model)
    {
        parent::__construct($model);
    }

    public function deleteByMenuId($menuId)
    {
        TagerMenuItem::query()->where('menu_id', '=', $menuId)->delete();
    }
}
