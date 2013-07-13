<?php

namespace spec\Gear\DependencyInjection\Factory;

use PhpSpec\ObjectBehavior;

class TreeBuilderFactorySpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\DependencyInjection\Factory\TreeBuilderFactory');
    }

    function its_create_should_return_a_treeBuilder_instance()
    {
        $this->create()->shouldHaveType('Symfony\Component\Config\Definition\Builder\TreeBuilder');
    }
}
