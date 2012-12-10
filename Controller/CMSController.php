<?php

namespace KFI\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CMSController extends Controller
{
    /**
     * @Route(
     *    "/c-p-{slug}/",
     *    requirements={"slug" = "^[a-z0-9\-]+$"},
     *    name="kfi_cms.post"
     * )
     */
    public function postAction($slug)
    {
        $post = $this->getPostByName($slug);
        return isset($post) ?
            $this->forward($this->container->getParameter('kfi_cms.action.post'), compact('post') )
            : $this->createNotFoundException(sprintf('The post "%s" does not exists', $slug));
    }

    /**
     * @Route(
     *    "/c-c-{slug}/",
     *    requirements={"slug" = "^[a-z0-9\-]+$"},
     *    name="kfi_cms.category"
     * )
     */
    public function categoryAction($slug)
    {
        $category = $this->getCategoryByName($slug);
        return isset($category) ?
            $this->forward($this->container->getParameter('kfi_cms.action.category'), compact('category') )
            : $this->createNotFoundException(sprintf('The category "%s" does not exists', $slug));
    }

    protected function getPostByName($name){
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('KFICMSBundle:Post')
            ->findOneBy(array('slug' => $name));
    }

    protected function getCategoryByName($name){
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('KFICMSBundle:Category')
            ->findOneBy(array('slug' => $name));
    }
}