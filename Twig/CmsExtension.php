<?php

namespace KFI\CmsBundle\Twig;

use Doctrine\Common\Persistence\ObjectManager;

use \Twig_Filter_Method as TwigFilter;
use \Twig_Function_Method as TwigFunction;
use \Twig_Extension as Extension;

class CmsExtension extends Extension
{
    protected $categoryRepo;
    protected $postRepo;

    public function __construct(ObjectManager $om, $postClass, $categoryClass)
    {
        $this->postRepo     = $om->getRepository($postClass);
        $this->categoryRepo = $om->getRepository($categoryClass);
    }

    public function getFunctions()
    {
        return array(
            'kfi_cms_category'   => new TwigFunction($this, 'getCategory'),
            'kfi_cms_categories' => new TwigFunction($this, 'getCategories'),
            'kfi_cms_post'       => new TwigFunction($this, 'getPost'),
            'kfi_cms_posts'      => new TwigFunction($this, 'getPosts')
        );
    }

    public function getName()
    {
        return 'kfi_cms_cms_extension';
    }

    public function getCategory($args)
    {
        $r = $this->categoryRepo;
        if (is_int($args))
            return $r->find($args);
        if (is_string($args))
            return $r->findOneBy(array('slug' => $args));
        else
            throw new \Exception('not implemented');
    }

    public function getPost($args)
    {
        $r = $this->postRepo;
        if (is_int($args))
            return $r->find($args);
        if (is_string($args))
            return $r->findOneBy(array('slug' => $args));
        else
            throw new \Exception('not implemented');
    }

    public function getCategories($args)
    {
        $r = $this->categoryRepo;
        if (is_int($args))
            return $r->find($args);
        if (is_string($args))
            return $r->findOneBy(array('slug' => $args));
        else
            throw new \Exception('not implemented');
    }

    public function getPosts($args)
    {
        $r = $this->postRepo;
        if (is_int($args))
            return $r->find($args);
        if (is_string($args))
            return $r->findOneBy(array('slug' => $args));
        else
            throw new \Exception('not implemented');
    }


}