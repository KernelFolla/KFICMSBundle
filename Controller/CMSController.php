<?php

namespace KFI\CmsBundle\Controller;

use KFI\CmsBundle\Interfaces\WebPage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CmsController extends Controller
{

    /**
     * @Route(
     *    "/p-{slug}/",
     *    requirements={"slug" = "^[a-z0-9\-\/]+$"},
     *    name="kfi_cms.post"
     * )
     */
    public function postAction($slug)
    {
        $post = $this->getPostByName($slug);
        if (!isset($post)) {
            throw $this->createNotFoundException();
        }

        return $this->forwardCMSAction('post', compact('post'));
    }

    /**
     * @Route(
     *    "/c-{slug}",
     *    requirements={"slug" = "^[a-z0-9\-\/]+$"},
     *    name="kfi_cms.category"
     * )
     */
    public function categoryAction($slug)
    {
        $splitted = $this->getSplittedSlug($slug);
        $post     = $this->getPostByName($splitted);
        if (isset($post)) {
            $this->maybeRedirect($post, $slug);
            return $this->forwardCMSAction('post', compact('post'));
        }
        $category = $this->getCategoryByName($splitted);
        if (isset($category)) {
            $this->maybeRedirect($category, $slug);
            return $this->forwardCMSAction('category', compact('category'));
        }

        throw $this->createNotFoundException();
    }

    protected function getPostByName($name)
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository($this->container->getParameter('kfi_cms.class.post'))
            ->findOneBy(array('slug' => $name));
    }

    protected function getCategoryByName($name)
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository($this->container->getParameter('kfi_cms.class.category'))
            ->findOneBy(array('slug' => $name));
    }

    private function forwardCMSAction($actionKey, $data)
    {
        return $this->forward(
            $this->getActionKey($actionKey),
            $data
        );
    }

    private function getActionKey($actionKey)
    {
        return $this->container->getParameter('kfi_cms.action.' . $actionKey);
    }

    private function getSplittedSlug($slug)
    {
        $x = explode('/', trim($slug, '/'));
        return array_pop($x);
    }

    private function maybeRedirect(WebPage $page, $currentUrl)
    {
        $pageUrl = $this->generateUrl(
            $page->getRouteName(),
            $page->getRouteParameters()
        );
        return ($pageUrl != $currentUrl) ?
            $this->redirect($pageUrl)
            : null;
    }
}