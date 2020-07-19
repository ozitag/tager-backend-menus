<?php

namespace OZiTAG\Tager\Backend\Menus;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Kalnoy\Nestedset\NestedSet;
use OZiTAG\Tager\Backend\Menus\Commands\FlushMenusCommand;

class TagerBackendMenusServiceProvider extends RouteServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Blueprint::macro('nestedSet', function () {
            NestedSet::columns($this);
        });

        Blueprint::macro('dropNestedSet', function () {
            NestedSet::dropColumns($this);
        });
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

        parent::boot();
    }
}
