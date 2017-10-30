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
use Symfony\Component\HttpFoundation\Request;

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

    public function likesAction(Request $request, $nickname = null){
        $em = $this->getDoctrine()->getManager();

        if($nickname != null){
            $user_repo = $em->getRepository('BackendBundle:User');
            $user = $user_repo->findOneBy(array('nick' => $nickname));
        }else{
            $user = $this->getUser();
        }
        if (empty($user) ||!is_object($user)){
            return $this->redirect($this->generateUrl('home_publications') );
        }else{
            $user_id = $user->getId();
            $dql = "SELECT l FROM BackendBundle:Like l WHERE l.user = $user_id ORDER BY l.id DESC";
            $query = $em->createQuery($dql);

            $paginator = $this->get('knp_paginator');
            $likes = $paginator->paginate(
                $query,
                $request->query->getInt('page',1),
                5
            );
        }

        return $this->render('AppBundle:Like:likes.html.twig', array(
            'profile_user' => $user,
            'pagination' => $likes
        ));
    }
}