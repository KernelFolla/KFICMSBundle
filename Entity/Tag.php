<?php

namespace KFI\CmsBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use KFI\CmsBundle\Interfaces\WebPage;

/**
 * @ORM\Entity
 * @ORM\Table(name="kfi_cms_tag")
 */
class Tag implements WebPage
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @ORM\Column(name="title", type="string", length=64)
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    private $posts;

    public function __toString(){
        return $this->getTitle();
    }

    public function getRouteName()
    {
        return 'cms.tag';
    }

    public function getRouteParameters()
    {
        return array('slug' => $this->getSlug());
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return MacroCategory
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return MacroCategory
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Tag
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Add posts
     *
     * @param Post $posts
     * @return Tag
     */
    public function addPost(Post $posts)
    {
        $this->posts[] = $posts;
    
        return $this;
    }

    /**
     * Remove posts
     *
     * @param Post $posts
     */
    public function removePost(Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}