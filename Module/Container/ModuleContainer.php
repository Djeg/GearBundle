<?php

namespace Gear\Module\Container;

use Gear\Module\ModuleInterface;

class ModuleContainer implements \IteratorAggregate
{
    private $modules;

    public function __construct()
    {
        $this->modules = [];
    }

    public function addModule(ModuleInterface $module)
    {
        $this->modules[] = $module;

        return $this;
    }

    public function hasModule($moduleName)
    {
        foreach ($this->modules as $module) {
            if ($module->getName() === $moduleName) {

                return true;
            }
        }

        return false;
    }

    public function getModule($moduleName)
    {
        foreach ($this->modules as $module) {
            if ($module->getName() === $moduleName) {

                return $module;
            }
        }

        return null;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->modules);
    }
}
