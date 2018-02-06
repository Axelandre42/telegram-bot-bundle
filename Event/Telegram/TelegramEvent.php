<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\Event\Telegram;

final class TelegramEvent
{
    public const UPDATE = 'ialert_telegram_bot.event.update';
    public const WEBHOOK = 'ialert_telegram_bot.event.webhook';
}
