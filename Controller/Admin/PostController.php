<?php

namespace KFI\CmsBundle\Controller\Admin;

use KFI\CmsBundle\Controller\Model\WebPageAdminController;
use KFI\CmsBundle\Entity\Post;

class PostController extends WebPageAdminController
{
    const ADMIN_SERVICE_NAME = 'kfi_cms.admin.post';
    const AUTOCOMPLETE_MAX_RESULTS = 10;

    public function configure()
    {
        $req = $this->getRequest();
        if (!$req->get('_sonata_admin'))
            $req->attributes->set('_sonata_admin', self::ADMIN_SERVICE_NAME);
        parent::configure();
    }

    public function autocompleteAction()
    {
        $req = $this->getRequest()->query;
        $ret = array();
        foreach ($this->getByTitle($req->get('term')) as $post) {
            $ret[] = array(
                'id'    => $post->getID(),
                'label' => $post->getTitle(),
                'edit'  => $this->generateUrl('admin_kfi_cms_post_edit', array('id' => $post->getId())),
                'url'   => $this->generateUrl($post->getRouteName(), $post->getRouteParameters())
            );
        }
        return $this->renderJson($ret);
    }

    /**
     * @param $title
     * @return Post[]
     */
    private function getByTitle($title)
    {
        return $this->getRepo()->createQueryBuilder('o')
            ->where('o.title LIKE :title')
            ->setParameter('title', '%' . $title . '%')
            ->setMaxResults(self::AUTOCOMPLETE_MAX_RESULTS)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    private function getRepo()
    {
        return $this->getDoctrine()
            ->getManager()
            ->getRepository($this->admin->getClass());
    }
}


