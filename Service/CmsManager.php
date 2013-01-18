<?php

namespace KFI\CMSBundle\Service;

use KFI\CmsBundle\Interfaces\WebPage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

class CmsManager {
    protected $router;
    protected $request;

    public function __construct(RouterInterface $router){
        $this->router = $router;
    }

    public function setRequest(Request $request){
        $this->request = $request;
    }

    public function isCurrent(WebPage $webpage){

    }
}
