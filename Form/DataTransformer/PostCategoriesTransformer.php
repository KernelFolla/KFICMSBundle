<?php

namespace KFI\CmsBundle\Form\DataTransformer;

use KFI\FrameworkBundle\Form\DataTransformer\JunctionTableTransformer;
use KFI\CmsBundle\Entity\PostCategory;
use KFI\CmsBundle\Entity\Category;

class PostCategoriesTransformer extends JunctionTableTransformer
{
    /**
     * @param PostCategory $item
     * @return Category
     */
    protected function transformItem($item)
    {
        return $item->getCategory();
    }

    /**
     * @param Category $item
     * @param int $pos
     * @return PostCategory
     */
    protected function createNewItem($item, $pos)
    {
        $ret = new PostCategory();
        $ret->setCategoryPosition($item->getPosts()->count());
        $ret->setCategory($item);
        $item->addCategoryPost($ret);
        $ret->setPostPosition($pos);
        return $ret;
    }

    /**
     * @param PostCategory $item
     * @param int $pos
     * @return PostCategory
     */
    protected function bindTmpItem($item, $pos){
        $item->setPostPosition($pos);
        return $item;
    }
}