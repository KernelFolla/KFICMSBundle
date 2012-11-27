<?php

namespace KFI\CMSBundle\Controller\Model;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class WebPageAdminController extends Controller
{

    public function showAction($id = null)
    {
        $id = $this->get('request')->get($this->admin->getIdParameter());

        /** @var $object \KFI\CMSBundle\Interfaces\WebPage */
        $object = $this->admin->getObject($id);

        if (!$object) {
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));
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
}