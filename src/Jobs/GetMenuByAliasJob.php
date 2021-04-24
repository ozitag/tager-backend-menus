<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;
use OZiTAG\Tager\Backend\Menus\TagerMenus;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetMenuByAliasJob extends Job
{
    private $alias;

    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $model = TagerMenus::getMenu($this->alias);

        if (!$model) {
            throw new NotFoundHttpException(__('tager-menus::errors.menu_not_found'));
        }

        return $model;
    }
}
