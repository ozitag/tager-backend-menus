<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\QueueJob;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;

class RemoveMenuJob
{
    private $model;

    public function __construct(TagerMenu $model)
    {
        $this->model = $model;
    }

    public function handle(MenuRepository $repository)
    {
        return $this->model->delete();
    }
}
