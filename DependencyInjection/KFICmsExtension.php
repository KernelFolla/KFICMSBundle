<?php

namespace KFI\CmsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class KFICMSExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        foreach ($config as $groupKey => $group) {
            foreach ($group as $key => $value) {
                $container->setParameter(sprintf('kfi_cms.%s.%s', $groupKey, $key), $value);
            }
        }
//
//        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
//        $loader->load('services.yml');
    }
}
