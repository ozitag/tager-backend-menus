<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\QueueJob;
use OZiTAG\Tager\Backend\Mail\Enums\TagerMailStatus;
use OZiTAG\Tager\Backend\Mail\Exceptions\TagerMailSenderException;
use OZiTAG\Tager\Backend\Mail\Models\TagerMailLog;
use App\Models\Product;
use App\Repositories\Interfaces\IProductReviewRepository;
use OZiTAG\Tager\Backend\Mail\Repositories\MailLogRepository;
use OZiTAG\Tager\Backend\Mail\Senders\SenderFactory;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailAttachments;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailConfig;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailSender;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenu;
use OZiTAG\Tager\Backend\Menus\Models\TagerMenuItem;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuItemsRepository;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;

class SaveMenuItemsJob
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
            'parent_id' => $parent ? $parent->id : null,
            'label' => $item['label'],
            'link' => $item['link'],
            'is_new_tab' => $item['isNewTab'],
        ]);

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
