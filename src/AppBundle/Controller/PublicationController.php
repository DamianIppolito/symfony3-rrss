<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 20/10/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicationController extends Controller
{
    public function indexAction(Request $request){
        return $this->render('AppBundle:Publication:home.html.twig', array(
        ));
    }
}