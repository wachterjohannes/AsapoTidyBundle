<?php

namespace Asapo\Bundle\TidyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('asapo_tidy');

        $rootNode
            ->children()
                ->arrayNode('config')
                    ->prototype('scalar')->end()
                ->end()
                ->scalarNode('encoding')->defaultValue('utf8')->end()
                ->scalarNode('response_listener')->defaultValue(true)->end()
                ->scalarNode('data_collector')->defaultValue(true)->end()
            ->end();

        return $treeBuilder;
    }
}
