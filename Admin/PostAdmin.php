<?php

namespace KFI\CmsBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class PostAdmin extends Base
{
    public function __construct($code, $class, $baseControllerName)
    {
        parent::__construct($code, $class, $baseControllerName);

        if (!$this->hasRequest()) {
            $this->datagridValues['_sort_order'] = 'DESC';
            $this->datagridValue['_sort_by']     = 'updatedAt';
        }
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $imageSettings      = array(
            'type'          => 'image',
            'add_to_editor' => true,
            'mode'          => 'single',
            'required'      => false
        );
        $attachmentSettings = array(
            'prototype'     => 'KFI\CmsBundle\Entity\PostAttachment',
            'type'          => 'all',
            'add_to_editor' => true,
            'required'      => false
        );
        $contentSettings    = array(
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
            ->add('image', 'kfi_upload', $imageSettings)
            ->add('postCategories', 'kfi_cms_postcategories')
            ->add('publishedAt', null, array('required' => false));
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
            'image'      => array('template' => 'KFIUploadBundle:Admin:list_upload.html.twig'),
            'datetime'   => array('template' => 'KFIFrameworkBundle:Admin:list_datetime.html.twig'),
            'categories' => array('template' => 'KFICmsBundle:Admin:list_categories.html.twig')
        );

        $listMapper
            ->add('image', null, $templates['image'])
            ->addIdentifier('title')
            ->add('categories', $templates['categories'])
            ->add('createdAt', null, $templates['datetime'])
            ->add('updatedAt', null, $templates['datetime'])
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