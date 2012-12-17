<?php

namespace KFI\CMSBundle\Form\DataTransformer;

use \KFI\CMSBundle\Entity;
use \Doctrine\Common\Collections\Collection;

class PostCategoryProxy extends Entity\PostCategory
{
    protected $entity;

    public function __construct(Entity\PostCategory $entity){
        $this->entity = $entity;
    }

    public function getId()
    {
        return $this->entity->getId();
    }

    public function setCategoryPosition($categoryPosition)
    {
        $this->entity->setCategoryPosition($categoryPosition);
        return $this;
    }

    public function getCategoryPosition()
    {
        return $this->entity->getCategoryPosition();
    }

    public function setPostPosition($postPosition)
    {
        $this->entity->setPostPosition($postPosition);
        return $this;
    }

    public function getPostPosition()
    {
        return $this->entity->getPostPosition();
    }

    public function setPost(Entity\Post $post)
    {
        $this->entity->setPost($post);

        return $this;
    }

    public function getPost()
    {
        return $this->entity->getPost();
    }

    public function setCategory(Entity\Category $category)
    {
        $this->entity->setCategory($category);

        return $this;
    }

    public function getCategory()
    {
        return $this->entity->getCategory();
    }

    public function pushOnPostCollection(Entity\Post $parent, Collection $collection){
        $this->entity->pushOnPostCollection($parent, $collection);
    }

    public function pushOnCategoryCollection(Entity\Category $parent, Collection $collection){
        $this->entity->pushOnCategoryCollection($parent, $collection);
    }
}