<?php

namespace spec\Gear\DependencyInjection\Compiler;

use PhpSpec\ObjectBehavior;

class ModuleCompilerPassSpec extends ObjectBehavior
{
    /**
     * @param Symfony\Component\DependencyInjection\ContainerBuilder     $container
     * @param Symfony\Component\DependencyInjection\ContainerBuilder     $emptyContainer
     * @param Symfony\Component\DependencyInjection\Definition           $moduleContainerDefinition
     * @param Gear\DependencyInjection\Compiler\Factory\ReferenceFactory $factory
     * @param Symfony\Component\DependencyInjection\Reference            $reference
     */
    function let(
        $container,
        $emptyContainer,
        $moduleContainerDefinition,
        $factory,
        $reference
    )
    {
        $container
            ->hasDefinition('gear.module.module_container')
            ->willReturn(true)
        ;
        $container
            ->getDefinition('gear.module.module_container')
            ->willReturn($moduleContainerDefinition)
        ;
        $container
            ->findTaggedServiceIds('gear.module')
            ->willReturn([
                'id' => ['some tags']
            ])
        ;

        $factory->create('id')->willReturn($reference);

        $moduleContainerDefinition
            ->addMethodCall('addModule', [$reference])
            ->willReturn(null)
        ;

        $this->beConstructedWith($factory);

        $emptyContainer
            ->hasDefinition('gear.module.module_container')
            ->willReturn(false)
        ;
    }

    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\DependencyInjection\Compiler\ModuleCompilerPass');
    }

    function it_should_be_a_valid_compiler_pass()
    {
        $this->shouldHaveType('Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface');
    }

    function its_process_should_add_module_to_the_module_container_definition(
        $container,
        $reference,
        $moduleContainerDefinition
    )
    {
        $container
            ->hasDefinition('gear.module.module_container')
            ->shouldBeCalled(1)
        ;
        $container
            ->getDefinition('gear.module.module_container')
            ->shouldBeCalled(1)
        ;
        $container
            ->findTaggedServiceIds('gear.module')
            ->shouldBeCalled(1)
        ;
        $moduleContainerDefinition
            ->addMethodCall('addModule', [$reference])
            ->shouldBeCalled(1)
        ;

        $this->process($container);
    }

    function its_process_should_not_process_if_no_module_container_definition_exists(
        $emptyContainer
    )
    {
        $emptyContainer
            ->getDefinition('gear.module.module_container')
            ->shouldNotBeCalled()
         ;

        $this
            ->process($emptyContainer)
            ->shouldReturn(null)
        ;
    }
}
