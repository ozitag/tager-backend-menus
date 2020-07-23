<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuItemsRepository;

class SaveMenuItemsJob extends Job
{
    private $menu;

    private $items;

    public function __construct(TagerMenu $menu, $items)
    {
        $this->menu = $menu;
        $this->items = $items;
    }

    private function rec(?TagerMenuItem $parent, $item)
    {
        $model = new TagerMenuItem([
            'menu_id' => $this->menu->id,
            'label' => $item['label'],
            'link' => $item['link'],
            'is_new_tab' => $item['isNewTab'],
        ]);

        $model->parent_id = $parent ? $parent->id : null;
        $model->save();

        if (isset($item['children']) && is_array($item['children'])) {
            foreach ($item['children'] as $child) {
                $this->rec($model, $child);
            }
        }
    }

    public function handle(MenuItemsRepository $menuItemsRepository)
    {
        $menuItemsRepository->deleteByMenuId($this->menu->id);

        foreach ($this->items as $item) {
            $this->rec(null, $item);
        }

        return $this->menu;
    }
}
