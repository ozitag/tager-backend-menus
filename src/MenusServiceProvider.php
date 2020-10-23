<?php

namespace OZiTAG\Tager\Backend\Menus;

use Kalnoy\Nestedset\NestedSetServiceProvider;
use OZiTAG\Tager\Backend\Mail\Enums\MenusScope;
use OZiTAG\Tager\Backend\Menus\Console\FlushMenusCommand;
use OZiTAG\Tager\Backend\Rbac\TagerScopes;

class MenusServiceProvider extends NestedSetServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../migrations');

        $this->publishes([
            __DIR__ . '/../config.php' => config_path('tager-menus.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                FlushMenusCommand::class,
            ]);
        }

        TagerScopes::registerGroup('Menus', [
            MenusScope::Edit => 'Edit menus'
        ]);
    }
}
