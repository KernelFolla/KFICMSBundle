<?php

namespace KFI\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use \KFI\UploadBundle\Entity\Upload;
use \DateTime;

use KFI\CmsBundle\Interfaces\WebPage;

/**
 * Post
 *
 * @ORM\Table(name="kfi_cms_post")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @Gedmo\Loggable
 */
class Post implements WebPage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="excerpt", type="text", nullable=true)
     */
    private $excerpt;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=64, unique=false)
     */
    private $slug;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="PostAttachment",
     *      mappedBy="parent",
     *      cascade={"persist"}, orphanRemoval=true )
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $attachments;

    /**
     * @ORM\OneToOne(
     *      targetEntity="KFI\UploadBundle\Entity\Upload",
     *      cascade={"all"},
     *      fetch="EAGER"
     * )
     * @ORM\JoinColumn(
     *      name="upload_id",
     *      nullable=true,
     *      referencedColumnName="id",
     *      onDelete="CASCADE"
     * )
     */
    private $image;

    /**
     * @var Collection|PostCategory[]
     * @ORM\OneToMany(targetEntity="PostCategory",
     *      mappedBy="post",
     *      cascade={"persist"},
     *      orphanRemoval=true
     * )
     * @ORM\OrderBy({"postPosition" = "ASC"})
     */
    private $postCategories;

    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="posts")
     * @ORM\JoinTable(
     *      name="kfi_cms_post_tags"
     * )
     */
    private $tags;

    /**
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $publishedAt;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

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
     * @return Post
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
     * Set excerpt
     *
     * @param string $excerpt
     * @return Post
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
    
        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string 
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postCategories = new ArrayCollection();
    }
    
    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Post
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
     * Set slug
     *
     * @param string $slug
     * @return Post
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Post
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    
        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Add attachments
     *
     * @param PostAttachment $attachments
     * @return Post
     */
    public function addAttachment(PostAttachment $attachments)
    {
        $attachments->pushOnCollection($this, $this->attachments);
    
        return $this;
    }

    /**
     * Remove attachments
     *
     * @param PostAttachment $attachments
     */
    public function removeAttachment(PostAttachment $attachments)
    {
        $this->attachments->removeElement($attachments);
    }

    /**
     * Get attachments
     *
     * @return Collection
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    public function getRouteName()
    {
        return $this->getCategory() ? 'kfi_cms.category' : 'kfi_cms.post';
    }

    public function getRouteParameters()
    {
        $slug = $this->getSlug();
        if($cat = $this->getCategory()){
            $r = $cat->getRouteParameters();
            $slug = $r['slug'].$slug;
        }
        return array('slug' => $slug);
    }

    public function __toString(){
        return $this->getTitle();
    }

    /**
     * Set image
     *
     * @param Upload $image
     * @return Post
     */
    public function setImage(Upload $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return Upload
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add post categories
     *
     * @param PostCategory $category
     * @return Post
     */
    public function addPostCategory(PostCategory $category)
    {
        $this->postCategories->add($category);
        $category->setPost($this);

        return $this;
    }

    /**
     * Remove post categories
     *
     * @param PostCategory $postCategory
     */
    public function removePostCategory(PostCategory $postCategory)
    {
        $this->postCategories->removeElement($postCategory);
    }

    /**
     * Get post categories
     *
     * @return Collection
     */
    public function getPostCategories()
    {
        return $this->postCategories;
    }

    /**
     * Add tags
     *
     * @param Category $tags
     * @return Post
     */
    public function addTag(Category $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param Category $tags
     */
    public function removeTag(Category $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return Collection
     */
    public function getTags()
    {
        return $this->tags;
    }


    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    
        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if($this->getPublishedAt() == null && $this->getEnabled())
            $this->setPublishedAt(new \DateTime());
    }

    /**
     * @return Category
     */
    public function getCategory(){
        $c = $this->getPostCategories();
        return $this->getPostCategories()->isEmpty() ? null
            : $c->offsetGet(0)->getCategory();
    }



    public function getCategories(){
        $ret = new ArrayCollection();
        foreach($this->postCategories as $item)
            $ret->add($item->getCategory());
        return $ret;
    }


    public function getBreadcrumbs(){
        $ret = ($cat = $this->getCategory()) ?
            $cat->getBreadCrumbs() :
            array();
        $ret[] = $this;
        return $ret;
    }
}