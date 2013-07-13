<?php

namespace spec\Gear\DependencyInjection;

use PhpSpec\ObjectBehavior;

class GearExtensionSpec extends ObjectBehavior
{
    /**
     * @param Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    function let($container)
    {
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\DependencyInjection\GearExtension');
    }

    function it_should_be_a_valid_extension()
    {
        $this->shouldHaveType('Symfony\Component\DependencyInjection\Extension\Extension');
    }

    function its_getConfiguration_should_return_a_valid_configuration($container)
    {
        $this
            ->getConfiguration([], $container)
            ->shouldHaveType('Symfony\Component\Config\Definition\ConfigurationInterface');
        ;
    }
}
