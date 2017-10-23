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


class UserController extends Controller
{
    public function loginAction(Request $request){
        return $this->render('AppBundle:User:login.html.twig', array(
            "title" => "PRUEBA"
        ));
    }

    public function registerAction(Request $request){

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        return $this->render('AppBundle:User:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

}