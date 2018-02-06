<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\Telegram\Command;

class CommandChain
{
    /**
     * @var CommandInterface[]
     */
    private $commands;

    public function __construct()
    {
        $this->commands = [];
    }

    /**
     * @param CommandInterface $command
     */
    public function addCommand(CommandInterface $command)
    {
        $this->commands[] = $command;
    }

    /**
     * @return CommandInterface[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }
}
