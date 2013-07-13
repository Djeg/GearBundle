<?php

namespace spec\Gear\Routing\Factory;

use PhpSpec\ObjectBehavior;

class RouteCollectionFactorySpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\Routing\Factory\RouteCollectionFactory');
    }

    function its_create_should_return_a_route_collection()
    {
        $this->create()->shouldHaveType('Symfony\Component\Routing\RouteCollection');
    }
}
