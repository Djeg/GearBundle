<?php

namespace spec\Gear\DependencyInjection\Factory;

use PhpSpec\ObjectBehavior;

class ProcessorFactorySpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\DependencyInjection\Factory\ProcessorFactory');
    }

    function its_create_should_return_a_processor()
    {
        $this
            ->create()
            ->shouldHaveType('Symfony\Component\Config\Definition\Processor')
        ;
    }
}
