<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;

class GetMenuByAliasJob extends Job
{
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $model = TagerMenu::query()->where('alias', '=', $this->alias)->first();

        if (!$model) {
            abort(404, 'Menu not found');
        }

        return $model;
    }
}
