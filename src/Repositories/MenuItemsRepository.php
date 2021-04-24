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

    public function deleteByMenuAlias(string $menuAlias)
    {
        TagerMenuItem::query()->where('menu_alias', '=', $menuAlias)->delete();
    }
}
