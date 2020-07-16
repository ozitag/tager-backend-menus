<?php

namespace OZiTAG\Tager\Backend\Menus\Features\Admin;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Feature;
use OZiTAG\Tager\Backend\Core\SuccessResource;
use OZiTAG\Tager\Backend\Menus\Jobs\GetMenuByIdJob;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;

class ViewItemsFeature extends Feature
{
    private $menu_id;

    public function __construct($menuId)
    {
        $this->menu_id = $menuId;
    }

    public function handle()
    {
        $model = $this->run(GetMenuByIdJob::class, ['id' => $this->menu_id]);

        $tree = TagerMenuItem::scoped(['menu_id' => $model->id])->get()->toTree();

        $result = [];

        $traverse = function ($items) use (&$traverse) {
            $result = [];

            foreach ($items as $item) {
                $result[] = [
                    'id' => $item->id,
                    'label' => $item->label,
                    'link' => $item->link,
                    'isNewTab' => $item->is_new_tab,
                    'children' => $traverse($item->children)
                ];
            }

            return $result;
        };

        $result = $traverse($tree);

        return new JsonResource($result);
    }
}
