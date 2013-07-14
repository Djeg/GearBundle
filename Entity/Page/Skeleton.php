<?php

namespace Gear\Entity\Page;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gear_page_skeleton")
 */
class Skeleton
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $layout
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $layout;

    /**
     * @var array $blocks
     * @ORM\Column(type="array")
     */
    private $blocks;

    public function __construct()
    {
        $this->blocks = [];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getLayout()
    {
        return $this->layout;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    public function getBlocks()
    {
        return $this->blocks;
    }

    public function setBlocks(array $blocks)
    {
        $this->blocks = $blocks;

        return $this;
    }

    public function addBlock($blockName, array $modules = [])
    {
        $this->blocks[$blockName] = $modules;

        return $this;
    }

    public function hasBlock($blockName)
    {
        return isset($this->blocks[$blockName]);
    }

    public function deleteBlock($blockName)
    {
        if (isset($this->blocks[$blockName])) {
            unset($this->blocks[$blockName]);
        }

        return $this;
    }

    public function getModules($blockName)
    {
        return isset($this->blocks[$blockName]) ?
            $this->blocks[$blockName] :
            null
        ;
    }

    public function addModule($blockName, $moduleName)
    {
        if (!isset($this->blocks[$blockName])) {
            $this->blocks[$blockName] = [];
        }

        $this->blocks[$blockName][] = $moduleName;

        return $this;
    }

    public function hasModule($blockName, $moduleName)
    {
        if (!isset($this->blocks[$blockName])) {
            return false;
        }

        foreach ($this->blocks[$blockName] as $name) {
            if ($name === $moduleName) {
                return true;
            }
        }

        return false;
    }
}
