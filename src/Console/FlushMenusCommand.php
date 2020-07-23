<?php

namespace OZiTAG\Tager\Backend\Menus\Console;

use Illuminate\Console\Command;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;

class FlushMenusCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tager:menus-flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync DB Menus with config';

    public function handle(MenuRepository $repository)
    {
        $menus = config()->get('tager-menus.menus');
        if (!$menus) {
            return;
        }

        foreach ($menus as $alias => $label) {
            $model = $repository->findByAlias($alias);

            if (!$model) {
                $model = $repository->createModelInstance();
                $model->alias = $alias;
            }

            $model->label = $label;
            $model->save();
        }
    }
}
