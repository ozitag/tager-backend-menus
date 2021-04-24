<?php

namespace OZiTAG\Tager\Backend\Menus\Controllers;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Menus\Features\Admin\UpdateMenuFeature;
use OZiTAG\Tager\Backend\Menus\Features\Admin\ViewMenuFeature;

class AdminController extends Controller
{
    public function view(string $alias)
    {
        return $this->serve(ViewMenuFeature::class, [
            'alias' => $alias
        ]);
    }

    public function update(string $alias)
    {
        return $this->serve(UpdateMenuFeature::class, [
            'alias' => $alias
        ]);
    }
}
