<?php

namespace KFI\CMSBundle\Twig\Extensions;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouterInterface;
use KFI\CMSBundle\Interfaces\WebPage;
use \Locale;
use \DateTime;

class CMSExtension extends \Twig_Extension
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getFilters()
    {
        return array(
            'wp_path' => new \Twig_Filter_Method($this, 'filterWebPagePath'),
            'wp_url'  => new \Twig_Filter_Method($this, 'filterWebPageUrl'),
        );
    }

    public function filterWebPagePath(WebPage $entity)
    {
        return $this->router->generate(
            $entity->getRouteName(),
            $entity->getRouteParameters()
        );
    }

    public function filterWebPageUrl(WebPage $entity)
    {
        return $this->router->generate(
            $entity->getRouteName(),
            $entity->getRouteParameters(),
            true
        );
    }

    public function getName()
    {
        return 'kfi_cms_extension';
    }
}