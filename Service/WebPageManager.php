<?php

namespace KFI\CmsBundle\Service;

use KFI\CmsBundle\Interfaces\WebPage;
use KFI\CmsBundle\WebPageUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

class WebPageManager {
    protected $router;
    protected $request;
    protected $current;

    public function __construct(RouterInterface $router){
        $this->router = $router;
    }

    public function isCurrent(WebPage $webpage, $request = null){
        if($this->current == $webpage)
            return true;
        else if(isset($request))
            return WebPageUtils::isCurrent($webpage, $request);
        else
            return false;
    }

    public function setCurrent(WebPage $webpage){
        $this->current = $webpage;
    }

    public function generateUrl(WebPage $webpage, $absolute = false){
        return $this->router->generate(
            $webpage->getRouteName(),
            $webpage->getRouteParameters(),
            $absolute
        );
    }
}
