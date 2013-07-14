<?php

namespace spec\Gear\DependencyInjection\Factory;

use PhpSpec\ObjectBehavior;

class XmlFileLoaderFactorySpec extends ObjectBehavior
{
    function it_should_be_initializable()
    {
        $this->shouldHaveType('Gear\DependencyInjection\Factory\XmlFileLoaderFactory');
    }

    /**
     * @param Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @param Symfony\Component\Config\FileLocatorInterface          $locator
     */
    public function its_create_should_return_an_xml_file_loader($container, $locator)
    {
        $this
            ->create($container, $locator)
            ->shouldHaveType('Symfony\Component\DependencyInjection\Loader\XmlFileLoader')
        ;
    }
}
