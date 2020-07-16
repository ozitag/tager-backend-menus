<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuItemsRepository;

class GetMenuItemsTreeJob
{
    private $menu;

    public function __construct(TagerMenu $menu)
    {
        $this->menu = $menu;
    }

    public function handle(MenuItemsRepository $menuItemsRepository)
    {
        $tree = TagerMenuItem::scoped(['menu_id' => $this->menu->id])->get()->toTree();

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

        return $traverse($tree);
    }
}
