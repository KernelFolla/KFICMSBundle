<?php
namespace KFI\CMSBundle;

use \Symfony\Component\HttpFoundation\Request;
use \KFI\CMSBundle\Interfaces\WebPage;

class WebPageUtils
{
    static public function isCurrent(WebPage $wp, Request $request){
        if($request->get('_route') != $wp->getRouteName())
            return false;
        $params = $wp->getRouteParameters();
        foreach($request->get('_route_params') as $k => $v)
            if($params[$k] != $v)
                return false;
        return true;
    }
}
