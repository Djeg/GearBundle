<?php

namespace Gear\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Gear\DependencyInjection\Factory\TreeBuilderFactory;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Gear\DependencyInjection\Factory\XmlFileLoaderFactory;
use Gear\DependencyInjection\Factory\FileLocatorFactory;
use Gear\DependencyInjection\Factory\ProcessorFactory;

class GearExtension extends Extension
{
    private $configuration;
    private $loaderFactory;
    private $locatorFactory;
    private $processorFactory;

    public function __construct(
        XmlFileLoaderFactory $loaderFactory = null,
        FileLocatorFactory $locatorFactory = null,
        ProcessorFactory $processorFactory = null
    )
    {
        $this->loaderFactory  = $loaderFactory ?: new XmlFileLoaderFactory;
        $this->locatorFactory = $locatorFactory ?: new FileLocatorFactory;
        $this->processorFactory = $processorFactory ?: new ProcessorFactory;
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this
            ->processorFactory
            ->create()
            ->processConfiguration($configuration, $configs)
        ;

        $locator = $this
            ->locatorFactory
            ->create(dirname(__DIR__).'/Resources/config')
        ;

        $loader = $this
            ->loaderFactory
            ->create($container, $locator)
        ;

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
