<?php

namespace KFI\CmsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;

class Base extends Admin
{
    public function getFormTheme()
    {
        return array('KFICmsBundle:Admin:fields.html.twig');
    }


    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'KFICmsBundle:Admin:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}