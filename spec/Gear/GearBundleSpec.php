<?php

namespace spec\Gear;

use PhpSpec\ObjectBehavior;

class GearBundleSpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\GearBundle');
    }

    function it_should_be_a_valid_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\BundleInterface');
    }

    function its_getContainerExtension_should_return_a_gear_extension()
    {
        $this
            ->getContainerExtension()
            ->shouldHaveType('Gear\DependencyInjection\GearExtension')
        ;
    }
}
