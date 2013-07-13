<?php

namespace spec\Gear\Routing;

use PhpSpec\ObjectBehavior;

class GearLoaderSpec extends ObjectBehavior
{
    /**
     * @param Symfony\Component\Config\FileLocatorInterface  $locator
     * @param Gear\Routing\Parser\YamlParser                 $parser
     * @param Gear\Routing\Builder\RouteBuilderInterface     $builder
     * @param Gear\Routing\Factory\RouteCollectionFactory    $factory
     * @param Symfony\Component\Routing\RouteCollection      $routeCollection
     */
    function let(
        $locator,
        $parser,
        $builder,
        $factory,
        $routeCollection
    )
    {
        $factory->create()->willReturn($routeCollection);

        $locator->locate('resource')->willReturn('/resource/absolute/path');

        $builder->getName()->willReturn('builder_name');
        $builder
            ->build($routeCollection, ['arguments'], ['options'])
            ->willReturn($routeCollection)
        ;

        $parser->parse('/resource/absolute/path')->willReturn([
            'builder_name:arguments' => [
                'options'
            ]
        ]);

        $this->beConstructedWith($locator, $parser, $factory);
        $this->addBuilder($builder);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\Routing\GearLoader');
    }

    function it_should_ba_a_valid_route_loader()
    {
        $this->shouldHaveType('Symfony\Component\Config\Loader\LoaderInterface');
    }

    function it_should_support_gear_route_type()
    {
        $this
            ->supports('', 'gear')
            ->shouldReturn(true)
        ;
    }

    function its_load_should_return_a_route_collection(
        $locator,
        $parser,
        $builder,
        $factory,
        $routeCollection
    )
    {
        $locator->locate('resource')->shouldBeCalled(1);
        $parser->parse('/resource/absolute/path')->shouldBeCalled(1);
        $builder
            ->build($routeCollection, ['arguments'], ['options'])
            ->shouldBeCalled(1)
        ;
        $factory->create()->shouldBeCalled(1);

        $this->load('resource')->shouldReturn($routeCollection);
    }
}
