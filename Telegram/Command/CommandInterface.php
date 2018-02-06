<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\Telegram\Command;

use Ialert\TelegramBotBundle\Event\Telegram\UpdateEvent;
use TelegramBot\Api\BotApi;

interface CommandInterface
{
    /**
     * @param BotApi      $api
     * @param UpdateEvent $event
     *
     * @return mixed
     */
    public function execute(BotApi $api, UpdateEvent $event);

    /**
     * @param UpdateEvent $event
     *
     * @return bool
     */
    public function isApplicable(UpdateEvent $event): bool;
}
