<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuItemsRepository;

class SaveMenuItemsJob extends Job
{
    protected string $alias;

    protected array $items;

    public function __construct(string $alias, array $items)
    {
        $this->alias = $alias;

        $this->items = $items;
    }

    private function rec(?TagerMenuItem $parent, $item)
    {
        $model = new TagerMenuItem([
            'menu_alias' => $this->alias,
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
        $menuItemsRepository->deleteByMenuAlias($this->alias);

        foreach ($this->items as $item) {
            $this->rec(null, $item);
        }
    }
}
