<?php

namespace KFI\CMSBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class PostAdmin extends Admin
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

        $imageSettings    = array(
            'type'          => 'image',
            'add_to_editor' => true,
            'mode'        => 'single'
        );

        $attachmentSettings    = array(
            'prototype'     => 'KFI\CMSBundle\Entity\PostAttachment',
            'type'          => 'all',
            'add_to_editor' => true
        );
        $contentSettings   = array(
            'attr' => array(
                'class'      => 'tinymce',
                'data-theme' => 'medium'
            )
        );
        $formMapper
            ->add('enabled', 'checkbox', array('required' => false))
            ->add('title', null, array('label' => 'Titolo'))
            ->add('content', 'textarea', $contentSettings)
            ->add('attachments', 'kfi_upload', $attachmentSettings)
            ->add('excerpt')
            ->add('image', 'kfi_upload', $imageSettings);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('enabled');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $templates = array(
            'image'    => array('template' => 'KFIUploadBundle:Admin:list_upload.html.twig')
//            'datetime' => array('template' => 'KFIFrameworkBundle:Admin:list_datetime.html.twig')
        );

        $listMapper
            ->add('image', null, $templates['image'])
            ->addIdentifier('title')
            ->add('createdAt', 'string')//, $templates['datetime'])
            ->add('updatedAt', 'string')//, $templates['datetime'])
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


    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
                return 'KFICMSBundle:Admin:edit_post.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
}