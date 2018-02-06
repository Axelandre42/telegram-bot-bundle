<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class CommandCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container): void
    {
        /** @var Definition $chain */
        $chain = $container->getDefinition('ialert_telegram_bot.command_chain');

        $commands = $container->findTaggedServiceIds('ialert_telegram_bot.command');
        foreach ($commands as $serviceId => $tags) {
            $command = new Reference($serviceId);
            $chain->addMethodCall(
                'addCommand',
                [
                    $command,
                ]
            );
        }
    }
}
