<?php

namespace Gear\Routing\Builder;

use Symfony\Component\Routing\RouteCollection;

interface RouteBuilderInterface
{
    public function getName();

    public function build(RouteCollection $collection, array $argument, array $options);
}
