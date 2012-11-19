<?php

namespace KFI\CMSBundle\Twig\Extensions;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouterInterface;
use KFI\CMSBundle\Interfaces\WebPage;
use \Locale;
use \DateTime;
use \IntlDateFormatter;

class CMSExtension extends \Twig_Extension
{
    protected $router;
    protected $settedLocale;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function getFilters()
    {
        return array(
            'wp_path' => new \Twig_Filter_Method($this, 'filterWebPagePath'),
            'wp_url'  => new \Twig_Filter_Method($this, 'filterWebPageUrl'),
            'intldate'   => new \Twig_Filter_Method($this, 'filterIntlDate'),
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

    public function filterIntlDate($date, $format)
    {
        if (!isset($this->settedLocale)) {
            $this->settedLocale = new IntlDateFormatter(Locale::getDefault(
            ), IntlDateFormatter::NONE, IntlDateFormatter::NONE);
            $this->settedLocale->setPattern($format);
        }
        if (!($date instanceof \DateTime)) {
            $date = new Datetime($date);
        }

        return $this->settedLocale->format($date);
    }
}