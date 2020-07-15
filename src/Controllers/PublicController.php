<?php

namespace OZiTAG\Tager\Backend\Menus\Controllers;

use OZiTAG\Tager\Backend\Core\Controller;
use OZiTAG\Tager\Backend\Menus\Guest\ViewMenuFeature;

class PublicController extends Controller
{
    public function menu($alias)
    {
        return $this->serve(ViewMenuFeature::class, [
            'alias' => $alias
        ]);
    }
}
