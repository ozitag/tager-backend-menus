<?php

namespace OZiTAG\Tager\Backend\Menus\Repositories;

use OZiTAG\Tager\Backend\Core\Repositories\EloquentRepository;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;

class MenuRepository extends EloquentRepository
{
    public function __construct(TagerMenu $model)
    {
        parent::__construct($model);
    }
}
