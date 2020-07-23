<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;

class CreateMenuJob extends Job
{
    private $alias;

    private $label;

    public function __construct($alias, $label)
    {
        $this->alias = $alias;
        $this->label = $label;
    }

    public function handle(MenuRepository $repository)
    {
        return $repository->create([
            'alias' => $this->alias,
            'label' => $this->label
        ]);
    }
}
