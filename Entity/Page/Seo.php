<?php

namespace Gear\Entity\Page;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gear_page_seo")
 */
class Seo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $title
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string $metaDescription
     * @ORM\Column(type="text")
     */
    private $metaDescription;

    /**
     * @var array $metaKeywords
     * @ORM\Column(type="array")
     */
    private $metaKeywords;

    /**
     * @var Page $page
     * @ORM\OneToOne(targetEntity="page")
     */
    private $page;

    public function __construct()
    {
        $this->metaKeywords = [];
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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function addMetaKeyword($metaKeyword)
    {
        $this->metaKeywords[] = $metaKeyword;

        return $this;
    }

    public function getMetaKeyword($metaKeyword)
    {
        foreach ($this->metaKeywords as $value) {
            if ($value === $metaKeyword) {

                return $value;
            }
        }

        return null;
    }

    public function hasMetaKeyword($metaKeyword)
    {
        foreach ($this->metaKeywords as $value) {
            if ($value === $metaKeyword) {

                return true;
            }
        }

        return false;
    }

    public function removeMetaKeyword($metaKeyword)
    {
        foreach ($thhis->metaKeywords as $key => $value) {
            if ($value === $metaKeyword) {
                unset($this->metaKeywords[$key]);

                return $this;
            }
        }

        return $this;
    }

    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(array $metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage(Page $page)
    {
        $this->page = $page;

        return $this;
    }
}
