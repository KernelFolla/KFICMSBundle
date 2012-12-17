<?php

namespace KFI\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 *
 * @ORM\Entity
 * @ORM\Table(
 *      name="kfi_cms_post_category",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"post_id", "category_id"})}
 * )
 */
class PostCategory
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Post",
     *      inversedBy="categories", cascade={"persist"} )
     * @ORM\JoinColumn(name="post_id", nullable=false,
     *      referencedColumnName="id")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="Category",
     *      inversedBy="posts", cascade={"persist"} )
     * @ORM\JoinColumn(name="category_id", nullable=false,
     *      referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\Column(type="smallint")
     */
    private $categoryPosition;

    /**
     * @ORM\Column(type="smallint")
     */
    private $postPosition;

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
     * Set categoryPosition
     *
     * @param integer $categoryPosition
     * @return PostCategory
     */
    public function setCategoryPosition($categoryPosition)
    {
        $this->categoryPosition = $categoryPosition;

        return $this;
    }

    /**
     * Get categoryPosition
     *
     * @return integer
     */
    public function getCategoryPosition()
    {
        return $this->categoryPosition;
    }

    /**
     * Set postPosition
     *
     * @param integer $postPosition
     * @return PostCategory
     */
    public function setPostPosition($postPosition)
    {
        $this->postPosition = $postPosition;

        return $this;
    }

    /**
     * Get postPosition
     *
     * @return integer
     */
    public function getPostPosition()
    {
        return $this->postPosition;
    }

    /**
     * Set post
     *
     * @param Post $post
     * @return PostCategory
     */
    public function setPost(Post $post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return PostCategory
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

//    public function pushOnPostCollection(Post $parent){
//        $this->setPost($parent);
//        $this->setPostPosition($post->collection->count());
//        $collection->add($this);
//    }
//
//    public function pushOnCategoryCollection(Category $parent, Collection $collection){
//        $this->setCategory($parent);
//        $this->setCategoryPosition($collection->count());
//        $collection->add($this);
//    }
}