<?php

namespace KFI\CMSBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class CategoryAdmin extends Base
{
    public function __construct($code, $class, $baseControllerName)
    {
        parent::__construct($code, $class, $baseControllerName);

        if (!$this->hasRequest()) {
            $this->datagridValues = array(
                '_page'       => 1,
                '_sort_order' => 'DESC', // sort direction
                '_sort_by'    => 'updatedAt' // field name
            );
        }
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('enabled', 'checkbox', array('required' => false))
            ->add('title')
            ->add('parent')
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