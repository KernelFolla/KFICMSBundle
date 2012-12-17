<?php

namespace KFI\CMSBundle\Form\DataTransformer;

use KFI\FrameworkBundle\Form\DataTransformer\JunctionTableTransformer;
use KFI\CMSBundle\Entity\PostCategory;
use KFI\CMSBundle\Entity\Post;

class CategoryPostsTransformer extends JunctionTableTransformer
{
    /**
     * @param PostCategory $item
     * @return object
     */
    protected function transformItem($item)
    {
        return $item->getPost();
    }


    /**
     * @param Post $item
     * @param int $pos
     * @return PostCategory
     */
    protected function createNewItem($item, $pos)
    {
        $ret = new PostCategory();
        $ret->setPostPosition($item->getCategories()->count());
        $ret->setCategory($item);
        $item->addCategory($ret);
        $ret->setPostPosition($pos);
        return $ret;
    }

    /**
     * @param PostCategory $item
     * @param int $pos
     * @return PostCategory
     */
    protected function bindTmpItem($item, $pos){
        $item->setCategoryPosition($pos);
        return $item;
    }
}