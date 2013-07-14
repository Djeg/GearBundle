<?php

namespace Gear\DependencyInjection\Compiler\Factory;

use Symfony\Component\DependencyInjection\Reference;

class ReferenceFactory
{
    public function create($id)
    {
        return new Reference($id);
    }
}
