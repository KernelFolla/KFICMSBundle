<?php

namespace KFI\CmsBundle\Form\DataTransformer;

use KFI\FrameworkBundle\Form\DataTransformer\JunctionTableTransformer;
use KFI\CmsBundle\Entity\PostCategory;
use KFI\CmsBundle\Entity\Post;

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
        $item->addPostCategory($ret);
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