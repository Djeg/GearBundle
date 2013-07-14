<?php

namespace Gear\Module;

interface ModuleInterface
{
    public function getName();

    public function build();
}
