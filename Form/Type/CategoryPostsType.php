<?php

namespace KFI\CMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Persistence\ObjectManager;

use KFI\CMSBundle\Form\DataTransformer\CategoryPostsTransformer;

class CategoryPostsType extends AbstractType
{
    protected $postsRepo;
    protected $postCategoryRepo;

    /**
     * @param ObjectManager $entityManager
     * @param $postClassName
     * @param $postCategoryClassName
     */
    public function __construct(ObjectManager $entityManager, $postClassName, $postCategoryClassName)
    {
        $this->postRepo     = $entityManager->getRepository($postClassName);
        $this->postCategoryRepo = $entityManager->getRepository($postCategoryClassName);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'compound' => false
        ));
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new CategoryPostsTransformer(
            $this->postCategoryRepo,
            $this->postRepo
        );
        $builder->addViewTransformer($transformer);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'kfi_cms_categoryposts';
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['full_name']  = $view->vars['full_name'] . '[]';
    }
}
