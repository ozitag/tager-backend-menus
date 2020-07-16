<?php

namespace OZiTAG\Tager\Backend\Menus\Commands;

use Illuminate\Console\Command;
use OZiTAG\Tager\Backend\Mail\Models\TagerMailTemplate;
use OZiTAG\Tager\Backend\Mail\Repositories\MailTemplateRepository;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;
use OZiTAG\Tager\Backend\Seo\Models\SeoPage;
use OZiTAG\Tager\Backend\Seo\Repositories\SeoPageRepository;

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
