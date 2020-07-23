<?php

namespace OZiTAG\Tager\Backend\Menus\Controllers;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\Menus\Features\Guest\ViewMenuFeature;

class PublicController extends Controller
{
    public function menu($alias)
    {
        return $this->serve(ViewMenuFeature::class, [
            'alias' => $alias
        ]);
    }
}
