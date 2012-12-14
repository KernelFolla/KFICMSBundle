<?php

namespace KFI\CMSBundle\Form\DataTransformer;

use KFI\FrameworkBundle\Form\DataTransformer\JunctionTableTransformer;
use KFI\CMSBundle\Entity\PostCategory;

class PostCategoryTransformer extends JunctionTableTransformer
{
    /**
     * @param PostCategory $item
     * @return object
     */
    protected function transformItem($item){
        return $item->getCategory();
    }

    /**
     * @param object $item
     * @return \KFI\CMSBundle\Entity\PostCategory
     */
    protected function createNewItem($item)
    {
        $ret = new PostCategory();
        $item->addCategory($item);
        return $ret;
    }

}