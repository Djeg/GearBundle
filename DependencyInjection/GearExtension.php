<?php

namespace Gear\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Gear\DependencyInjection\Factory\TreeBuilderFactory;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;

class GearExtension extends Extension
{
    private $configuration;

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader(
            $container,
            new FileLocator(dirname(__DIR__).'/Resources/config')
        );

        foreach ($config['components'] as $name => $activated) {
            if ($activated) {
                $loader->load($name.'.xml');
            }
        }
    }

    public function getConfiguration(array $configs, ContainerBuilder $container)
    {
        if (null === $this->configuration) {
            $this->configuration = new Configuration(new TreeBuilderFactory);
        }

        return $this->configuration;
    }
}
