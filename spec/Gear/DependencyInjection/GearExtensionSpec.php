<?php

namespace spec\Gear\DependencyInjection;

use PhpSpec\ObjectBehavior;
use Symfony\Component\Config\FileLocator;
use Prophecy\Argument;

class GearExtensionSpec extends ObjectBehavior
{
    /**
     * @param Symfony\Component\DependencyInjection\ContainerBuilder     $container
     * @param Gear\DependencyInjection\Factory\XmlFileLoaderFactory      $fileFactory
     * @param Gear\DependencyInjection\Factory\FileLocatorFactory        $locatorFactory
     * @param Gear\DependencyInjection\Factory\ProcessorFactory          $processorFactory
     * @param Symfony\Component\Config\Definition\Processor              $processor
     * @param Symfony\Component\Config\FileLocator                       $locator
     * @param Symfony\Component\DependencyInjection\Loader\XmlFileLoader $loader
     */
    function let(
        $container,
        $fileFactory,
        $locatorFactory,
        $processorFactory,
        $processor,
        $locator,
        $loader
    )
    {
        $this->beConstructedWith($fileFactory, $locatorFactory, $processorFactory);

        $processorFactory
            ->create()
            ->willReturn($processor)
         ;

        $processor
            ->processConfiguration($this->getConfiguration(
                ['configs'],
                $container
            ), ['configs'])
            ->willReturn([
                'components' => [
                    'A' => true,
                    'B' => true,
                    'C' => false
                ]
            ])
        ;

        $locatorFactory
            ->create(Argument::any())
            ->willReturn($locator)
        ;

        $fileFactory
            ->create($container, $locator)
            ->willReturn($loader)
        ;

        $loader->load(Argument::cetera())->willReturn(null);
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

    function its_load_should_import_activated_components($container, $loader)
    {
        $loader->load('A.xml')->shouldBeCalled(1);
        $loader->load('B.xml')->shouldBeCalled(1);
        $loader->load('C.xml')->shouldNotBeCalled();

        $this->load(['configs'], $container);
    }
}
