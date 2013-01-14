<?php

namespace KFI\CmsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Persistence\ObjectManager;

use KFI\CmsBundle\Form\DataTransformer\PostCategoriesTransformer;
use KFI\CmsBundle\Entity\Category;

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
        $transformer = new PostCategoriesTransformer(
            $this->postCategoryRepo,
            $this->categoryRepo
        );
        $builder->addViewTransformer($transformer);
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
    }
}
