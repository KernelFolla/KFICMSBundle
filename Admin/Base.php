<?php

namespace KFI\CMSBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;

class Base extends Admin
{
    public function getFormTheme()
    {
        return array('KFICMSBundle:Admin:fields.html.twig');
    }


    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'KFICMSBundle:Admin:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}