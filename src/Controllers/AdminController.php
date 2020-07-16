<?php

namespace OZiTAG\Tager\Backend\Menus\Controllers;

use OZiTAG\Tager\Backend\Core\Controller;
use OZiTAG\Tager\Backend\Menus\Features\Admin\CreateMenuFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\CreateMenuItemFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\ListMenusFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\ListMenuItemsFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\RemoveMenuFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\RemoveMenuItemFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\UpdateItemsFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\UpdateMenuFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\UpdateMenuItemFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\ViewItemsFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\ViewMenuFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\ViewMenuItemFeature;

class AdminController extends Controller
{
    public function index()
    {
        return $this->serve(ListMenusFeature::class);
    }

    public function create()
    {
        return $this->serve(CreateMenuFeature::class);
    }

    public function view($id)
    {
        return $this->serve(ViewMenuFeature::class, [
            'id' => $id
        ]);
    }

    public function update($id)
    {
        return $this->serve(UpdateMenuFeature::class, [
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        return $this->serve(RemoveMenuFeature::class, [
            'id' => $id
        ]);
    }

    public function viewItems($id)
    {
        return $this->serve(ViewItemsFeature::class, [
            'menuId' => $id
        ]);
    }

    public function updateItems($id)
    {
        return $this->serve(UpdateItemsFeature::class, [
            'menuId' => $id
        ]);
    }
}
