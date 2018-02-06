<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle;

use Ialert\TelegramBotBundle\DependencyInjection\Compiler\CommandCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class IalertTelegramBotBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new CommandCompilerPass());
    }
}
