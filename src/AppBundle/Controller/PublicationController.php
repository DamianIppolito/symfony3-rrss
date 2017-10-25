<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 20/10/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;

use AppBundle\Form\PublicationType;
use BackendBundle\Entity\Publication;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicationController extends Controller
{
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class,$publication);

        return $this->render('AppBundle:Publication:home.html.twig', array(
            'form' => $form->createView()
        ));
    }
}