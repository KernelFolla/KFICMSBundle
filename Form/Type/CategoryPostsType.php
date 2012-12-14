<?php

namespace KFI\CMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Persistence\ObjectManager;

use KFI\CMSBundle\Form\DataTransformer\PostCategoryTransformer;
use KFI\FrameworkBundle\Form\DataTransformer\RepositoryTransformer;
use KFI\CMSBundle\Entity\Category;

class PostCategoriesType extends AbstractType
{
    protected $categoryRepo;
    protected $postCategoryRepo;

    /**
     * @param ObjectManager $entityManager
     * @param $categoryClassName
     * @param $postCategoryClassName
     */
    public function __construct(ObjectManager $entityManager, $categoryClassName, $postCategoryClassName)
    {
        $this->categoryRepo     = $entityManager->getRepository($categoryClassName);
        $this->postCategoryRepo = $entityManager->getRepository($postCategoryClassName);
    }

    protected function getRootCategories()
    {
        $ret = $this->categoryRepo->findAll();
        /** @var $cat Category */
        foreach ($ret as $k => $cat)
            if ($cat->getParent() != null)
                unset($ret[$k]);
        return $ret;
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
        $builder->addViewTransformer(
            new PostCategoryTransformer(
                $this->postCategoryRepo,
                new RepositoryTransformer($this->categoryRepo)
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'kfi_cms_postcategories';
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['categories'] = $this->getRootCategories();
        $view->vars['full_name']  = $view->vars['full_name'] . '[]';
    }
}
