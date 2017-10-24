<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 20/10/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;

use AppBundle\Form\RegisterType;
use AppBundle\Form\UserType;
use BackendBundle\Entity\User;
use BackendBundle\Entity\Following;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class FollowingController extends Controller{
    private $session;

    public function __construct(){
        $this->session = new Session();
    }

    public function followAction(Request $request){
        echo "Follow Action";
        die();
    }
}