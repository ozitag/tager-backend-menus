<?php

namespace OZiTAG\Tager\Backend\Menus;

use Kalnoy\Nestedset\NestedSetServiceProvider;
use OZiTAG\Tager\Backend\Menus\Console\FlushMenusCommand;

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
    }
}
