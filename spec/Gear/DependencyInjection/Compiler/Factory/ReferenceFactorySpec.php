<?php

namespace spec\Gear\DependencyInjection\Compiler\Factory;

use PhpSpec\ObjectBehavior;

class ReferenceFactorySpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\DependencyInjection\Compiler\Factory\ReferenceFactory');
    }

    function its_create_should_return_a_reference()
    {
        $this
            ->create('id')
            ->shouldHaveType('Symfony\Component\DependencyInjection\Reference')
        ;
    }
}
