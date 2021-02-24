<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\TagerVariables;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;

class GetMenuItemsTreeJob extends Job
{
    protected TagerMenu $menu;

    protected bool $replaceVariables;

    public function __construct(TagerMenu $menu, bool $replaceVariables = false)
    {
        $this->menu = $menu;

        $this->replaceVariables = $replaceVariables;
    }

    public function handle(TagerVariables $tagerVariables)
    {
        $tree = TagerMenuItem::scoped(['menu_id' => $this->menu->id])->get()->toTree();

        $traverse = function ($items) use (&$traverse, $tagerVariables) {
            $result = [];

            foreach ($items as $item) {
                $label = $this->replaceVariables ? $tagerVariables->processText($item->label) : $item->label;

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
