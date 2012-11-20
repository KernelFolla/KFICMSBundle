<?php

namespace KFI\CMSBundle\Interfaces;

interface WebPage
{
    /**
     * returns the route name to route the web page
     *
     * @abstract
     * @return string
     */
    function getRouteName();

    /**
     * returns the parameters to route the web page
     * @abstract
     * @return mixed
     */
    function getRouteParameters();
}
