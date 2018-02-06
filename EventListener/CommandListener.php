<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\EventListener;

use Ialert\TelegramBotBundle\Event\Telegram\UpdateEvent;
use Ialert\TelegramBotBundle\Telegram\Command\CommandChain;
use Ialert\TelegramBotBundle\Telegram\Command\CommandInterface;
use TelegramBot\Api\BotApi;

class CommandListener
{
    /**
     * @var BotApi
     */
    private $api;

    /**
     * @var CommandChain
     */
    private $commandChain;

    public function __construct(BotApi $api, CommandChain $commandChain)
    {
        $this->api = $api;
        $this->commandChain = $commandChain;
    }

    /**
     * @param UpdateEvent $event
     */
    public function onUpdate(UpdateEvent $event): void
    {
        if ($message = $event->getUpdate()->getMessage()) {
            /** @var CommandInterface $command */
            foreach ($this->commandChain->getCommands() as $command) {
                if (!$command->isApplicable($event)) {
                    continue;
                }

                $response = $command->execute($this->api, $event);
                if (null !== $response) {
                    $event->setResponse($response);
                }
                break;
            }
        }
    }
}
