<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Utils\TagerVariables;
use OZiTAG\Tager\Backend\Menus\Structures\TagerMenu;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;

class GetMenuItemsTreeJob extends Job
{
    protected string $alias;

    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    public function handle()
    {
        $tree = TagerMenuItem::scoped(['menu_alias' => $this->alias])->get()->toTree();

        $traverse = function ($items) use (&$traverse) {
            $result = [];

            foreach ($items as $item) {
                $result[] = [
                    'model' => $item,
                    'children' => $traverse($item->children)
                ];
            }

            return $result;
        };

        return $traverse($tree);

        /*
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
        };*/


        return $traverse($tree);
    }
}
