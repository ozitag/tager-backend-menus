<?php

namespace OZiTAG\Tager\Backend\Menus;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\App;
use OZiTAG\Tager\Backend\Menus\Structures\TagerMenu;
use OZiTAG\Tager\Backend\Panel\Contracts\IRouteHandler;
use OZiTAG\Tager\Backend\Panel\Structures\TagerRouteHandler;

class TagerMenus
{
    /** @var TagerMenu[] */
    private static $menus = [];

    /**
     * @return TagerMenu[]
     */
    public static function getMenus()
    {
        return self::$menus;
    }

    public static function getMenu(string $menuId): ?TagerMenu
    {
        return array_key_exists($menuId, self::$menus) ? self::$menus[$menuId] : null;
    }

    public static function registerMenu(string $menuId, string $menuName, bool $supportsTree = true)
    {
        if (array_key_exists($menuId, self::$menus)) {
            throw new \Exception('Menu "' . $menuId . '" has already existed');
        }

        self::$menus[$menuId] = new TagerMenu($menuName, $supportsTree);
    }
}
