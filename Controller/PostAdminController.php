<?php

namespace KFI\CMSBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use KFI\CMSBundle\Entity\Post;

class PostExtraAdminController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{

    /**
     * @Route(
     *    "/admin/kfi/cms/post/autocomplete",
     *    name="admin_kfi_cms_post_autocomplete"
     * )
     * @Method({"GET"})
     */
    public function autocompleteAction(){
        die('works');
        $req = $this->getRequest()->query;
        $title = $req->get('s');
        $repo = $this->getDoctrine()->getManager($this->admin->getClass());
        $title = '%'.$title.'%s';
        $ret = array();
        /** @var $post Post */
        foreach($repo->findBy($title) as $post){
            $ret[] = array(
                'id' => $post->getID(),
                'title' => $post->getTitle(),
                'edit' => $this->generateUrl('admin_kfi_cms_post_edit', array('id' => $post->getId())),
                'url' => $this->generateUrl($post->getRouteName(), $post->getRouteParameters())
            );
        }
        return $this->renderJson($ret);
    }
}
