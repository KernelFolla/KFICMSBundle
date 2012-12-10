<?php

namespace KFI\CMSBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Persistence\ObjectManager;

use KFI\FrameworkBundle\Form\DataTransformer\RepositoryTransformer;

class PostCategoriesType extends AbstractType
{
    protected $repo;
    protected $items;
    protected $uniqID;

    /**
     * @param ObjectManager $entityManager
     * @param string $repositoryName
     */
    public function __construct(ObjectManager $entityManager, $className)
    {
        $this->repo = $entityManager->getRepository($className);
        $this->items = $this->repo->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'uniqID' => '',
            'compound' => false
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent(){
        return 'form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->uniqID = $options['uniqID'];
        RepositoryTransformer::bind($builder, $this->repo);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'kficms_post_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace(
            $view->vars,
            array(
                'uniqID'        => $this->uniqID,
                'categories' => $this->items,
            )
        );
        $view->vars['full_name'] = $view->vars['full_name'].'[]';
    }
}
