<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuItemsRepository;
use OZiTAG\Tager\Backend\Menus\TagerMenus;

class GetMenuItemsTreeJob extends Job
{
    private $menu;

    public function __construct(TagerMenu $menu)
    {
        $this->menu = $menu;
    }

    public function handle(MenuItemsRepository $menuItemsRepository, TagerMenus $tagerMenus)
    {
        $tree = TagerMenuItem::scoped(['menu_id' => $this->menu->id])->get()->toTree();

        $traverse = function ($items) use (&$traverse, $tagerMenus) {
            $result = [];

            foreach ($items as $item) {

                $label = $item->label;

                $label = preg_replace_callback('#\{(.+?)\}#si', function ($item) use ($tagerMenus) {
                    if ($tagerMenus->isVariableExisted($item[1])) {
                        return $tagerMenus->getVariableValue($item[1]);
                    } else {
                        return $item[0];
                    }
                }, $label);
                
                $result[] = [
                    'id' => $item->id,
                    'label' => $label,
                    'link' => $item->link,
                    'isNewTab' => (bool)$item->is_new_tab,
                    'children' => $traverse($item->children)
                ];
            }

            return $result;
        };

        return $traverse($tree);
    }
}
