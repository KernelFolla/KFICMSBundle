<?php

namespace KFI\CmsBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('compa_compa');

        $rootNode
            ->children()
                ->arrayNode('action')
                    ->children()
                        ->scalarNode('post')->cannotBeEmpty()->end()
                        ->scalarNode('category')->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('post')->defaultValue('KFI\CmsBundle\Entity\Post')->cannotBeEmpty()->end()
                        ->scalarNode('category')->defaultValue('KFI\CmsBundle\Entity\Category')->cannotBeEmpty()->end()
                        ->scalarNode('postcategory')->defaultValue('KFI\CmsBundle\Entity\PostCategory')->cannotBeEmpty()->end()
                        ->scalarNode('tag')->defaultValue('KFI\CmsBundle\Entity\Tag')->cannotBeEmpty()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
