<?php

namespace KFI\CmsBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use KFI\CmsBundle\Interfaces\WebPage;

/**
 * @ORM\Entity
 * @ORM\Table(name="kfi_cms_category")
 * @ORM\HasLifecycleCallbacks
 */
class Category implements WebPage
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
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     */
    private $parent;

    /**
     * @var Collection|PostCategory[]
     * @ORM\OneToMany(targetEntity="PostCategory",
     *      mappedBy="category",
     *      cascade={"persist"}, orphanRemoval=true, fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"categoryPosition" = "ASC"})
     */
    private $categoryPosts;

    /**
     * @ORM\Column(type="integer")
     */
    private $position = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $count = 0;

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getRouteName()
    {
        return 'kfi_cms.direct';
    }

    public function getRouteParameters()
    {
        $slug = '';
        $p    = $this;
        do {
            $slug = $p->getSlug() . '/' . $slug;
        } while ($p = $p->getParent());
        return array('slug' => $slug);
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categoryPosts    = new ArrayCollection();
        $this->children = new ArrayCollection();
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
     * @return Category
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
     * @return Category
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
     * @return Category
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
     * Add children
     *
     * @param Category $children
     * @return Category
     */
    public function addChildren(Category $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param Category $children
     */
    public function removeChildren(Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param Category $parent
     * @return Category
     */
    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Category
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add category posts
     *
     * @param PostCategory $post
     * @return Category
     */
    public function addCategoryPost(PostCategory $post)
    {
        $this->categoryPosts->add($post);
        $post->setCategory($this);
        return $this;
    }

    /**
     * Remove category post
     *
     * @param PostCategory $post
     */
    public function removePost(PostCategory $post)
    {
        $this->categoryPosts->removeElement($post);
    }

    /**
     * Get category posts
     *
     * @return PostCategory[]|Collection
     */
    public function getCategoryPosts()
    {
        return $this->categoryPosts;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|Post[]
     */
    public function getPosts(){
        $ret = new ArrayCollection();
        foreach($this->categoryPosts as $item)
            $ret->add($item->getPost());
        return $ret;
    }

    /**
     * @return Category[]
     */
    public function getBreadCrumbs()
    {
        $ret = array($this);
        $p   = $this;
        while ($p = $p->getParent())
            $ret[] = $p;
        return array_reverse($ret);
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return Category
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }


    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $count = $this->getCategoryPosts()->count();
    }
}