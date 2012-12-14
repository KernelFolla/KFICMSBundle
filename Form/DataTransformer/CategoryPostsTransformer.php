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
     * @return PostCategory
     */
    protected function createNewItem($item)
    {
        $ret = new PostCategory();
        $item->addCategory($ret);
        return $ret;
    }
}