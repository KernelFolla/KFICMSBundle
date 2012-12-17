<?php

namespace KFI\CMSBundle\Twig;

use Doctrine\Common\Persistence\ObjectManager;
use \Twig_Function_Method as Method;
use \Twig_Extension as Extension;

class CMSExtension extends Extension
{
    protected $categoryRepo;
    protected $postRepo;

    public function __construct(ObjectManager $om, $postClass, $categoryClass)
    {
        $this->postsRepo = $om->getRepository($postClass);
        $this->categoryRepo = $om->getRepository($categoryClass);
    }

    public function getFunctions()
    {
        return array(
            'kfi_cms_category' => new Method($this, 'getCategory')
        );
    }

    public function getName()
    {
        return 'kfi_cms_cms_extension';
    }

    public function getCategory($args){
        $r = $this->categoryRepo;
        if(is_int($args))
            return $r->find($args);
        if(is_string($args))
            return $r->findOneBy(array('slug' => $args));
        else
            throw new \Exception('not implemented');
    }
}