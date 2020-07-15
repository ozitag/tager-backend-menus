<?php

namespace OZiTAG\Tager\Backend\Menus\Controllers;

use OZiTAG\Tager\Backend\Core\Controller;
use OZiTAG\Tager\Backend\Menus\Admin\CreateMenuFeature;
use OZiTAG\Tager\Backend\Menus\Admin\CreateMenuItemFeature;
use OZiTAG\Tager\Backend\Menus\Admin\ListMenusFeature;
use OZiTAG\Tager\Backend\Menus\Admin\ListMenuItemsFeature;
use OZiTAG\Tager\Backend\Menus\Admin\RemoveMenuFeature;
use OZiTAG\Tager\Backend\Menus\Admin\RemoveMenuItemFeature;
use OZiTAG\Tager\Backend\Menus\Admin\UpdateMenuFeature;
use OZiTAG\Tager\Backend\Menus\Admin\UpdateMenuItemFeature;
use OZiTAG\Tager\Backend\Menus\Admin\ViewMenuFeature;
use OZiTAG\Tager\Backend\Menus\Admin\ViewMenuItemFeature;

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

    public function items($id)
    {
        return $this->serve(ListMenuItemsFeature::class, [
            'id' => $id
        ]);
    }

    public function createMenuItem($id)
    {
        return $this->serve(CreateMenuItemFeature::class, [
            'menuId' => $id
        ]);
    }

    public function updateMenuItem($id)
    {
        return $this->serve(UpdateMenuItemFeature::class, [
            'id' => $id
        ]);
    }

    public function viewMenuItem($id)
    {
        return $this->serve(ViewMenuItemFeature::class, [
            'id' => $id
        ]);
    }

    public function removeMenuItem($id)
    {
        return $this->serve(RemoveMenuItemFeature::class, [
            'id' => $id
        ]);
    }
}
