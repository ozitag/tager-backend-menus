<?php

namespace OZiTAG\Tager\Backend\Menus;

use Kalnoy\Nestedset\NestedSetServiceProvider;
use OZiTAG\Tager\Backend\Menus\Enums\MenusScope;
use OZiTAG\Tager\Backend\Menus\Console\FlushMenusCommand;
use OZiTAG\Tager\Backend\Rbac\TagerScopes;

class MenusServiceProvider extends NestedSetServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'tager-menus');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        TagerScopes::registerGroup(__('tager-menus::scopes.group'), [
            MenusScope::Edit => __('tager-menus::scopes.edit')
        ]);
    }
}
