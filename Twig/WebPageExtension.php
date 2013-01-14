<?php

namespace KFI\CmsBundle\Twig;

use \Twig_Filter_Method as Method;
use \Twig_Extension as Extension;

use Symfony\Component\Routing\RouterInterface;
use KFI\CmsBundle\Interfaces\WebPage;

class WebPageExtension extends Extension
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getFilters()
    {
        return array(
            'wp_path' => new Method($this, 'filterWebPagePath'),
            'wp_url'  => new Method($this, 'filterWebPageUrl'),
        );
    }

    public function filterWebPagePath(WebPage $entity = null)
    {
        return $this->router->generate(
            $entity->getRouteName(),
            $entity->getRouteParameters()
        );
    }

    public function filterWebPageUrl(WebPage $entity = null)
    {
        return $this->router->generate(
            $entity->getRouteName(),
            $entity->getRouteParameters(),
            true
        );
    }

    public function getName()
    {
        return 'kfi_cms_webpage_extension';
    }
}