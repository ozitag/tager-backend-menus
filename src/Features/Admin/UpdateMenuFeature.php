<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
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

    public function handle(MenuRequest $request)
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->id]);

        $model = $this->run(UpdateMenuJob::class, [
            'model' => $model,
            'alias' => $request->alias,
            'label' => $request->label
        ]);

        return new MenuResource($model);
    }
}