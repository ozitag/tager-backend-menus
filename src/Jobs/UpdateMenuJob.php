<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\QueueJob;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;

class UpdateMenuJob
{
    private $model;

    private $alias;

    private $label;

    public function __construct(TagerMenu $model, $alias, $label)
    {
        $this->model = $model;
        $this->alias = $alias;
        $this->label = $label;
    }

    public function handle(MenuRepository $repository)
    {
        $this->model->alias = $this->alias;
        $this->model->label = $this->label;
        $this->model->save();

        return $this->model;
    }
}
