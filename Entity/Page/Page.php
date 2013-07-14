<?php

namespace Gear\Entity\Page;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="gear_page_page")
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $identifier
     * @ORM\Column(type="string", length=100, unique=true, nullable=false)
     */
    private $identifier;

    /**
     * @var string $title
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string $content
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var Seo $seo
     * @ORM\OneToOne(targetEntity="Seo", mappedBy="page")
     */
    private $seo;

    /**
     * @var Skeleton $skeleton
     * @ORM\OneToOne(targetEntity="Skeleton", mappedBy="page")
     */
    private $skeleton;

    /**
     * @var Page $parentPage
     * @ORM\ManyToOne(targetEntity="page", inversedBy="subPages")
     */
    private $parentPage;

    /**
     * @var ArrayCollection $subPages
     * @ORM\OneToMany(targetEntity="page", mappedBy="parentPage")
     */
    private $subPages;

    /**
     * @var string $slug
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $slug;

    public function __construct()
    {
        $this->subPages = new ArrayCollection;
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

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

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

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    public function getSeo()
    {
        return $this->seo;
    }

    public function setSeo(Seo $seo)
    {
        $this->seo = $seo;

        return $this;
    }

    public function getSkeleton()
    {
        return $this->skeleton;
    }

    public function setSkeleton(Skeleton $skeleton)
    {
        $this->skeleton = $skeleton;

        return $this;
    }

    public function getParentPage()
    {
        return $this->parentPage;
    }

    public function setParentPage(Page $parentPage)
    {
        $this->parentPage = $parentPage;

        return $this;
    }

    public function hasParent()
    {
        return null !== $this->parentPage;
    }

    public function isRoot()
    {
        return false == $this->subPages->count();
    }

    public function addSubPage(Page $subPage)
    {
        $this->subPages->add($subPage);

        return $this;
    }

    public function getSubPage($subPage)
    {
        foreach ($this->subPages as $value) {
            if ($value->getIdentifier() == $subPage) {

                return $value;
            }
        }

        return null;
    }

    public function hasSubPage($subPage)
    {
        foreach ($this->subPages as $value) {
            if ($value->getIdentifier() == $subPage) {

                return true;
            }
        }

        return false;
    }

    public function removeSubPage($subPage)
    {
        foreach ($thhis->subPages as $key => $value) {
            if ($value->getIdentifier() == $subPage) {
                $this->subPages->remove($key);

                return $this;
            }
        }

        return $this;
    }

    public function getSubPages()
    {
        return $this->subPages;
    }

    public function getSlug()
    {
        if ($this->hasParent()) {
            return $this->getParentPage()->getSlug().'/'.$this->slug;
        }

        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
