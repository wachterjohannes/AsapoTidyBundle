<?php

namespace Asapo\Bundle\TidyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AsapoTidyExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        if ($config['config'] === null || sizeof($config['config']) === 0) {
            $container->setParameter('asapo_tidy.config', array('indent' => 2, 'output-xhtml' => 1, 'wrap' => 200));
        } else {
            $container->setParameter('asapo_tidy.config', $config['config']);
        }

        $container->setParameter('asapo_tidy.encoding', $config['encoding']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        // include definition of response listener if enabled
        if ($config['response_listener'] === true) {
            $loader->load('response_listener.xml');
        }

        // include definition of data collector if enabled
        if ($config['data_collector'] === true) {
            $loader->load('data_collector.xml');
        }
    }
}
