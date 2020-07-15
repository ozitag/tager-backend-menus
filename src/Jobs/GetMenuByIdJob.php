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

class GetMenuByIdJob
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function handle(MenuRepository $repository)
    {
        $model = $repository->find($this->id);
        if (!$model) {
            abort(404, 'Menu not found');
        }
        return $model;
    }
}
