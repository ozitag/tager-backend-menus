<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Menus\Jobs\CreateMenuJob;
use OZiTAG\Tager\Backend\Menus\Requests\MenuRequest;
use OZiTAG\Tager\Backend\Menus\Resources\MenuResource;

class CreateMenuFeature extends Feature
{
    public function handle(MenuRequest $request)
    {
        $model = $this->run(CreateMenuJob::class, [
            'alias' => $request->alias,
            'label' => $request->label,
        ]);

        return new MenuResource($model);
    }
}
