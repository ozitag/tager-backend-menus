<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\HttpCache\HttpCache;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;
use OZiTAG\Tager\Backend\Menus\Jobs\UpdateMenuJob;
use OZiTAG\Tager\Backend\Menus\Requests\MenuRequest;
use OZiTAG\Tager\Backend\Menus\Resources\MenuResource;

class UpdateMenuFeature extends Feature
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(MenuRequest $request, HttpCache $httpCache)
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->id]);

        $model = $this->run(UpdateMenuJob::class, [
            'model' => $model,
            'alias' => $request->alias,
            'label' => $request->label
        ]);

        $httpCache->clear('tager/menus');

        return new MenuResource($model);
    }
}
