<?php

namespace Gear\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Gear\DependencyInjection\Factory\TreeBuilderFactory;

class GearExtension extends Extension
{
    private $configuration;

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
    }

    public function getConfiguration(array $configs, ContainerBuilder $container)
    {
        if (null === $this->configuration) {
            $this->configuration = new Configuration(new TreeBuilderFactory);
        }

        return $this->configuration;
    }
}