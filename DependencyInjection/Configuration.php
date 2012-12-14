<?php

namespace KFI\CMSBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('kfi_cms');

        $rootNode
            ->children()
                ->arrayNode('actions')
                    ->children()
                        ->scalarNode('post')->cannotBeEmpty()->end()
                        ->scalarNode('category')->cannotBeEmpty()->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
