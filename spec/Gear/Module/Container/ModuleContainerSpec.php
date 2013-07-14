<?php

namespace spec\Gear\Module\Container;

use PhpSpec\ObjectBehavior;

class ModuleContainerSpec extends ObjectBehavior
{
    /**
     * @param Gear\Module\ModuleInterface $module
     */
    function let($module)
    {
        $module->getName()->willReturn('some.module');
        $this->addModule($module);
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\Module\Container\ModuleContainer');
    }

    function it_should_be_iterable()
    {
        $this->shouldHaveType('\IteratorAggregate');
    }

    function its_getModule_should_return_a_register_module_or_null($module)
    {
        $this
            ->getModule('some.module')
            ->shouldReturn($module)
        ;

        $this
            ->getModule('non_existent.module')
            ->shouldReturn(null)
        ;
    }

    function its_hasModule_should_test_a_module_existence($module)
    {
        $this
            ->hasModule('some.module')
            ->shouldReturn(true)
        ;

        $this
            ->hasModule('non_existent.module')
            ->shouldReturn(false)
        ;
    }
}
