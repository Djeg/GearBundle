<?php

namespace Gear\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Gear\DependencyInjection\Factory\TreeBuilderFactory;

class Configuration implements ConfigurationInterface
{
    private $factory;

    public function __construct(TreeBuilderFactory $factory)
    {
        $this->factory = $factory;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = $this->factory->create();
        $rootNode = $treeBuilder->root('gear');

        return $treeBuilder;
    }
}
