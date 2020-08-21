<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\HttpCache\HttpCache;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;
use OZiTAG\Tager\Backend\Menus\Jobs\RemoveMenuJob;

class RemoveMenuFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(HttpCache $httpCache)
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->id]);

        $this->run(RemoveMenuJob::class, ['model' => $model]);

        $httpCache->clear('tager/menus');

        return new SuccessResource();
    }
}
