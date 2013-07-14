<?php

namespace spec\Gear\ThemeBundle;

use PhpSpec\ObjectBehavior;

class BundleSpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\ThemeBundle\Bundle');
    }

    function it_should_be_a_valid_bundle()
    {
        $this->shouldHaveType('Symfony\Component\HttpKernel\Bundle\BundleInterface');
    }
}
