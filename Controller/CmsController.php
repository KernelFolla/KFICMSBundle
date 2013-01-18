<?php

namespace KFI\CmsBundle\Controller;

use KFI\CmsBundle\Interfaces\WebPage;
use KFI\CmsBundle\Service\WebPageManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CmsController extends Controller
{

    public function directAction($slug)
    {
        /** @var $wpManager WebPageManager */
        $wpManager = $this->get('kfi_cms.webpage_manager');
        $splitted  = $this->getSplittedSlug($slug);
        $post      = $this->getPostByName($splitted);

        if (isset($post)) {
            if ($ret = $this->mayRedirect($post, $slug)) {
                return $ret;
            }
            $this->mayRedirect($post, $slug);
            $wpManager->setCurrent($post);
            return $this->forwardCMSAction('post', compact('post'));
        }

        $category = $this->getCategoryByName($splitted);
        if (isset($category)) {
            if ($ret = $this->mayRedirect($category, $slug)) {
                return $ret;
            }
            $wpManager->setCurrent($category);
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

    private function mayRedirect(WebPage $page, $currentUrl)
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