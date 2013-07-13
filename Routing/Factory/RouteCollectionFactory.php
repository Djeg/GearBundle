<?php

namespace Gear\Routing\Factory;

use Symfony\Component\Routing\RouteCollection;

class RouteCollectionFactory
{
    public function create()
    {
        return new RouteCollection;
    }
}
