<?php

namespace KFI\CmsBundle\Twig;

use KFI\CMSBundle\Service\WebPageManager;
use \Twig_Extension as Extension;
use \Twig_Filter_Method as TwigFilter;
use \Twig_Function_Method as TwigFunction;
use KFI\CmsBundle\Interfaces\WebPage;

class WebPageExtension extends Extension
{
    protected $manager;

    public function __construct(WebPageManager $manager)
    {
        $this->manager = $manager;
    }

    public function getFilters()
    {
        return array(
            'wp_path' => new TwigFilter($this, 'filterWebPagePath'),
            'wp_url'  => new TwigFilter($this, 'filterWebPageUrl'),

        );
    }

    public function getFunctions(){
        return array(
            'wp_is_current' => new TwigFunction($this, 'isCurrentWebPage')
        );
    }

    public function filterWebPagePath(WebPage $entity = null)
    {
        return $this->manager->generateUrl($entity);
    }

    public function filterWebPageUrl(WebPage $entity = null)
    {
        return $this->manager->generateUrl($entity, true);
    }

    public function isCurrentWebPage($webpage){
        return $this->manager->isCurrent($webpage);
    }

    public function getName()
    {
        return 'kfi_cms_webpage_extension';
    }
}