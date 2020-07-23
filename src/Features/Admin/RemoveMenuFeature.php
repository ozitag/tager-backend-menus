<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;
use OZiTAG\Tager\Backend\Menus\Jobs\RemoveMenuJob;

class RemoveMenuFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->id]);

        $this->run(RemoveMenuJob::class, ['model' => $model]);

        return new SuccessResource();
    }
}
