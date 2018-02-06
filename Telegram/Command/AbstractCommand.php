<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\Telegram\Command;

use Ialert\TelegramBotBundle\Event\Telegram\UpdateEvent;

abstract class AbstractCommand implements CommandInterface
{
    /**
     * RegExp for bot commands.
     */
    protected const REGEXP = '/^([^\s@]+)(@\S+)?\s?(.*)$/';

    /**
     * @return string
     */
    abstract public function getName(): string;

    /**
     * {@inheritdoc}
     */
    public function isApplicable(UpdateEvent $event): bool
    {
        $message = $event->getUpdate()->getMessage();
        if (null === $message || '' === $message->getText()) {
            return false;
        }

        if ($this->matchCommandName($message->getText(), $this->getName())) {
            return true;
        }

        return false;
    }

    /**
     * @param string $text
     * @param string $name
     *
     * @return bool
     */
    private function matchCommandName($text, $name): bool
    {
        preg_match(self::REGEXP, $text, $matches);

        return !empty($matches) && $matches[1] === $name;
    }
}
