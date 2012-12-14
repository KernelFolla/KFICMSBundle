<?php

namespace KFI\CMSBundle\Form\DataTransformer;

use KFI\FrameworkBundle\Form\DataTransformer\JunctionTableTransformer;
use KFI\CMSBundle\Entity\PostCategory;
use KFI\CMSBundle\Entity\Category;

class PostCategoriesTransformer extends JunctionTableTransformer
{
    /**
     * @param PostCategory $item
     * @return object
     */
    protected function transformItem($item)
    {
        return $item->getCategory();
    }

    /**
     * @param Category $item
     * @return PostCategory
     */
    protected function createNewItem($item)
    {
        $ret = new PostCategory();
        $item->addPost($ret);
        return $ret;
    }

}