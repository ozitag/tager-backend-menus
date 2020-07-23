<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;

class RemoveMenuJob extends Job
{
    private $model;

    public function __construct(TagerMenu $model)
    {
        $this->model = $model;
    }

    public function handle()
    {
        return $this->model->delete();
    }
}
