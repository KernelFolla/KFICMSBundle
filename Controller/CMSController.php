<?php

namespace KFI\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CMSController extends Controller
{
    /**
     * @Route(
     *    "/p-{slug}/",
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

    protected function getPostByName($name){
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('KFICMSBundle:Post')
            ->findBy(array('slug' => $name));
    }

    protected function getCategoryByName($name){
        return $this->getDoctrine()
            ->getManager()
            ->getRepository('KFICMSBundle:Category')
            ->findBy(array('slug' => $name));
    }
}