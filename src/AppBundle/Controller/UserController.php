<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 20/10/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;

use AppBundle\Form\RegisterType;
use BackendBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller{
    private $session;

    public function __construct(){
        $this->session = new Session();
    }

    public function loginAction(Request $request){
        return $this->render('AppBundle:User:login.html.twig', array(
            "title" => "PRUEBA"
        ));
    }

    public function registerAction(Request $request){

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        $status = '';
        $message_class='alert-danger';
        if($form->isSubmitted()){
            if ($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                //$user_repo = $em->getRepository('BackendBundle:User');
                $query = $em->createQuery('SELECT u FROM BackendBundle:User u WHERE u.email = :email OR u.nick = :nick')
                            ->setParameter('email', $form->get('email')->getData())
                            ->setParameter('nick', $form->get('nick')->getData());
                $user_isset = $query->getResult();
                if(count($user_isset) == 0){
                    $factory = $this->get('security.encoder_factory');
                    $encoder = $factory->getEncoder($user);
                    $password = $encoder->encodePassword($form->get('password')->getData(), $user->getSalt());

                    $user->setPassword($password);
                    $user->setRole('ROLE_USER');
                    $user->setImage(null);

                    $em->persist($user);
                    $flush = $em->flush();
                    if ($flush == null){
                        $status = 'Te has registrado correctamente';
                        $message_class='alert-success';
                        $this->session->getFlashBag()->add("status",$status);
                        $this->session->getFlashBag()->add("message_class",$message_class);
                        return $this->redirect('login');
                    }else{
                        $status = 'No te has registrado correctamente';
                    }
                }else{
                    $status = 'El usuario ya existe';
                }

            }else{
                $status = 'No te has registrado correctamente';
            }

            $this->session->getFlashBag()->add("status",$status);
            $this->session->getFlashBag()->add("message_class",$message_class);
        }
        return $this->render('AppBundle:User:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function nickTestAction(Request $request){
        $nick = $request->get('nick');
        $em = $this->getDoctrine()->getManager();
        $user_repo = $em->getRepository('BackendBundle:User');
        $user_isset = $user_repo->findOneBy(array('nick'=>$nick));
        if(count($user_isset) >= 1 && is_object($user_isset)){
            $result = 'used';
        }else{
            $result = 'unused';
        }

        return new Response($result);
    }
}