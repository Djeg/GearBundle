<?php

namespace spec\Gear\DependencyInjection\Factory;

use PhpSpec\ObjectBehavior;

class FileLocatorFactorySpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\DependencyInjection\Factory\FileLocatorFactory');
    }

    function its_create_should_return_a_file_locator()
    {
        $this
            ->create('some/path')
            ->shouldHaveType('Symfony\Component\Config\FileLocator')
        ;
    }
}
