<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 20/10/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;

use BackendBundle\Entity\Like;
use BackendBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller{

    public function likeAction($id = null){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $publication_repo = $em->getRepository('BackendBundle:Publication');
        $publication = $publication_repo->find($id);

        $like = new Like();
        $like->setUser($user);
        $like->setPublication($publication);

        $em->persist($like);
        $flush = $em->flush();
        if($flush == null){
            $status = 'Te gusta esta publicación';
        }else{
            $status = 'No se ha podido guardar el me gusta';
        }

        return new Response($status);
    }

    public function unlikeAction($id = null){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $like_repo = $em->getRepository('BackendBundle:Like');
        $liked = $like_repo->findOneBy(array(
            'user' => $user,
            'publication' => $id
        ));

        $em->remove($liked);
        $flush = $em->flush();
        if($flush == null){
            $status = 'Ya no te gusta esta publicación';
        }else{
            $status = 'No se ha podido desmarcar el me gusta';
        }

        return new Response($status);
    }
}