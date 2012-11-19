<?php

namespace KFI\CMSBundle\Interfaces;

interface WebPage
{
    /**
     * @abstract
     * @return string
     */
    function getRouteName();

    /**
     * @abstract
     * @return mixed
     */
    function getRouteParameters();
}
