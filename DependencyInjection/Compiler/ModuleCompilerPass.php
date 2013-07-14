<?php

namespace Gear\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Gear\DependencyInjection\Compiler\Factory\ReferenceFactory;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class ModuleCompilerPass implements CompilerPassInterface
{
    public function __construct(ReferenceFactory $factory = null)
    {
        $this->factory = $factory ?: new ReferenceFactory;
    }

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('gear.module.module_container')) {
            return;
        }

        $definition = $container->getDefinition('gear.module.module_container');

        $taggedServices = $container->findTaggedServiceIds('gear.module');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addModule',
                array(
                    $this->factory->create($id)
                )
            );
        }
    }
}
