<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 20/10/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;

use AppBundle\Form\PrivateMessageType;
use BackendBundle\Entity\User;
use BackendBundle\Entity\PrivateMessage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class PrivateMessageController extends Controller{
    private $session;

    public function __construct(){
        $this->session = new Session();
    }

    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $private_message = new PrivateMessage();
        $form = $this->createForm(PrivateMessageType::class, $private_message, array('empty_data' => $user));

        return $this->render('@App/PrivateMessage/index.html.twig',array(
            'form' => $form->createView(),
            'titulo' => 'Titulo'
        ));
    }
}