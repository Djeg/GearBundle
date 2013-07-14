<?php

namespace Gear\DependencyInjection\Factory;

use Symfony\Component\Config\Definition\Processor;

class ProcessorFactory
{
    public function create()
    {
        return new Processor;
    }
}
