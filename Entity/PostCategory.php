<?php

namespace KFI\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use KFI\UploadBundle\Entity\EntityUpload;

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
     *  @ORM\ManyToOne(targetEntity="Post",
     *      inversedBy="categories", cascade={"persist"} )
     *  @ORM\JoinColumn(name="post_id", nullable=false,
     *      referencedColumnName="id")
     */
    private $post;

    /**
     *  @ORM\ManyToOne(targetEntity="Category",
     *      inversedBy="posts", cascade={"persist"} )
     *  @ORM\JoinColumn(name="category_id", nullable=false,
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
     * @param \KFI\CMSBundle\Entity\Post $post
     * @return PostCategory
     */
    public function setPost(\KFI\CMSBundle\Entity\Post $post)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \KFI\CMSBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set category
     *
     * @param \KFI\CMSBundle\Entity\Category $category
     * @return PostCategory
     */
    public function setCategory(\KFI\CMSBundle\Entity\Category $category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \KFI\CMSBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}