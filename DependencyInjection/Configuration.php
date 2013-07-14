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

        $rootNode
            ->children()
                ->append($this->getComponentsNode())
            ->end()
        ;

        return $treeBuilder;
    }

    public function getComponentsNode()
    {
        $builder = $this->factory->create();
        $node = $builder->root('components');

        $node
            ->info('Enable/Disable gear components')
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('routing')
                    ->info('Activate the routing gear loader services')
                    ->defaultValue(true)
                ->end()
            ->end()
        ;

        return $node;
    }
}
