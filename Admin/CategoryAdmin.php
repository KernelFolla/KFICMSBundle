<?php

namespace KFI\CmsBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class CategoryAdmin extends Base
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('enabled', 'checkbox', array('required' => false))
            ->add('title')
            ->add('parent')
            ->add('categoryPosts', 'kfi_cms_categoryposts')
            ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('enabled');
    }

    protected function configureListFields(ListMapper $listMapper)
    {

        $listMapper
            ->addIdentifier('title')
            ->add(
                '_action',
                'actions',
                array(
                    'actions' => array(
                        'view' => array(),
                        'edit' => array(),
                    )
                )
            );
    }
}