<?php

namespace spec\Gear\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class ConfigurationSpec extends ObjectBehavior
{
    /**
     * @param Gear\DependencyInjection\Factory\TreeBuilderFactory     $treeBuilderFactory
     * @param Symfony\Component\Config\Definition\Builder\TreeBuilder $treeBuilder
     */
    function let($treeBuilderFactory, $treeBuilder)
    {
        $this->beConstructedWith($treeBuilderFactory);

        $treeBuilderFactory->create()->willReturn(new TreeBuilder);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\DependencyInjection\Configuration');
    }

    function it_should_be_a_valid_configuration_class()
    {
        $this->shouldHaveType('Symfony\Component\Config\Definition\ConfigurationInterface');
    }

    function its_getConfigTreeBuilder_should_return_a_valid_treeBuilder(
        $treeBuilderFactory,
        $treeBuilder
    )
    {
        $treeBuilderFactory->create()->shouldBeCalled(1);

        $this
            ->getConfigTreeBuilder()
            ->shouldHaveType('Symfony\Component\Config\Definition\Builder\TreeBuilder')
        ;
    }

    function its_getComponentsNode_should_return_a_valid_node($treeBuilderFactory, $treeBuilder)
    {
        $treeBuilderFactory->create()->shouldBeCalled(1);

        $this
            ->getComponentsNode()
            ->shouldHaveType('Symfony\Component\Config\Definition\Builder\NodeDefinition')
        ;
    }
}
