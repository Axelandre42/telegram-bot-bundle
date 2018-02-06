<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\Telegram\Command;

interface PublicCommandInterface extends CommandInterface
{
    /**
     * @return string
     */
    public function getName(): string;
}
