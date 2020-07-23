<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;

class GetMenuByIdJob extends Job
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(MenuRepository $repository)
    {
        $model = $repository->find($this->id);
        if (!$model) {
            abort(404, 'Menu not found');
        }
        return $model;
    }
}
