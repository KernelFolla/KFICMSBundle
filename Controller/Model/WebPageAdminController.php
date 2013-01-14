<?php

namespace KFI\CmsBundle\Controller\Model;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use KFI\CmsBundle\Interfaces\WebPage;

class WebPageAdminController extends Controller
{
    public function showAction($id = null)
    {
        $object = $this->getWebPage();
        if (!$object) {
            return $this->createNotFoundException(sprintf('unable to find the object with id : %s', $id));
        }

        if (false === $this->admin->isGranted('VIEW', $object)) {
            throw new AccessDeniedException();
        }

        $this->admin->setSubject($object);

        return $this->redirect(
            $this->generateUrl(
                $object->getRouteName(),
                $object->getRouteParameters()
            )
        );
    }

    /**
     * @return WebPage
     */
    private function getWebPage(){
        $id = $this->get('request')->get($this->admin->getIdParameter());
        return $this->admin->getObject($id);
    }
}