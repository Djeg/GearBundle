<?php

namespace Gear\DependencyInjection\Factory;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class TreeBuilderFactory
{
    public function create()
    {
        return new TreeBuilder;
    }
}
