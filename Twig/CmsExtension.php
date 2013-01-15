<?php

namespace KFI\CmsBundle\Twig;

use Doctrine\Common\Persistence\ObjectManager;
use \Twig_Function_Method as Method;
use \Twig_Extension as Extension;

class CmsExtension extends Extension
{
    protected $categoryRepo;
    protected $postRepo;

    public function __construct(ObjectManager $om, $postClass, $categoryClass)
    {
        $this->postRepo = $om->getRepository($postClass);
        $this->categoryRepo = $om->getRepository($categoryClass);
    }

    public function getFunctions()
    {
        return array(
            'kfi_cms_category' => new Method($this, 'getCategory'),
            'kfi_cms_categories' => new Method($this, 'getCategories'),
            'kfi_cms_post' => new Method($this, 'getPost'),
            'kfi_cms_posts' => new Method($this, 'getPosts')
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

    public function getPost($args){
        $r = $this->postRepo;
        if(is_int($args))
            return $r->find($args);
        if(is_string($args))
            return $r->findOneBy(array('slug' => $args));
        else
            throw new \Exception('not implemented');
    }

    public function getCategories($args){
        $r = $this->categoryRepo;
        if(is_int($args))
            return $r->find($args);
        if(is_string($args))
            return $r->findOneBy(array('slug' => $args));
        else
            throw new \Exception('not implemented');
    }

    public function getPosts($args){
        $r = $this->postRepo;
        if(is_int($args))
            return $r->find($args);
        if(is_string($args))
            return $r->findOneBy(array('slug' => $args));
        else
            throw new \Exception('not implemented');
    }



}