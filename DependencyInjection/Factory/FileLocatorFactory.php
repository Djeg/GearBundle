<?php

namespace Gear\DependencyInjection\Factory;

use Symfony\Component\Config\FileLocator;

class FileLocatorFactory
{
    public function create($path)
    {
        return new FileLocator($path);
    }
}
