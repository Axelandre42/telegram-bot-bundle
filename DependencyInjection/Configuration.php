<?php

declare(strict_types=1);

namespace Ialert\TelegramBotBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ialert_telegrambot');

        $rootNode
            ->children()
            ->arrayNode('api')->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('username')->isRequired()->end()
            ->scalarNode('token')->isRequired()->end()
            ->end()
            ->end()
            ->arrayNode('tracker')->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('token')->isRequired()->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
