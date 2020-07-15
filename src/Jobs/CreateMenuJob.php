<?php

namespace OZiTAG\Tager\Backend\Menus\Jobs;

use OZiTAG\Tager\Backend\Core\QueueJob;
use OZiTAG\Tager\Backend\Mail\Enums\TagerMailStatus;
use OZiTAG\Tager\Backend\Mail\Exceptions\TagerMailSenderException;
use OZiTAG\Tager\Backend\Mail\Models\TagerMailLog;
use App\Models\Product;
use App\Repositories\Interfaces\IProductReviewRepository;
use OZiTAG\Tager\Backend\Mail\Repositories\MailLogRepository;
use OZiTAG\Tager\Backend\Mail\Senders\SenderFactory;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailAttachments;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailConfig;
use OZiTAG\Tager\Backend\Mail\Utils\TagerMailSender;
use OZiTAG\Tager\Backend\Menus\Repositories\MenuRepository;

class CreateMenuJob
{
    private $alias;

    private $label;

    public function __construct($alias, $label)
    {
        $this->alias = $alias;
        $this->label = $label;
    }

    public function handle(MenuRepository $repository)
    {
        return $repository->create([
            'alias' => $this->alias,
            'label' => $this->label
        ]);
    }
}
