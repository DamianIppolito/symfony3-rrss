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
use Symfony\Component\HttpFoundation\Session\Session;

class PublicationController extends Controller{
    private $session;

    public function __construct(){
        $this->session = new Session();
    }

    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class,$publication);
        $form->handleRequest($request);
        $message_class='alert-danger';
        if($form->isSubmitted()){
            if($form->isValid()){
                //upload image
                $file = $form['image']->getData();
                if(!empty($file) && $file != null){
                    $ext = $file->guessExtension();
                    if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif'){
                        $file_name = $user->getId().time().'.'.$ext;
                        $file->move('uploads/publications/images',$file_name);
                        $publication->setImage($file_name);
                    }else{
                        $publication->setImage(null);
                    }
                }else{
                    $publication->setImage(null);
                }

                //upload document
                $document = $form['document']->getData();
                if(!empty($document) && $document != null){
                    $ext = $document->guessExtension();
                    if($ext == 'pdf'){
                        $file_name = $user->getId().time().'.'.$ext;
                        $document->move('uploads/publications/documents',$file_name);
                        $publication->setDocument($file_name);
                    }else{
                        $publication->setDocument(null);
                    }
                }else{
                    $publication->setDocument(null);
                }

                $publication->getUser($user);
                $publication->setCreatedAt(new \DateTime('now'));
                $em->persist($publication);
                $flush = $em->flush();
                if($flush == null){
                    $status = 'La publicación se ha creado correctamente';
                    $message_class='alert-success';
                }else{
                    $status = 'Error al añadir la publicación';
                }
            }else{
                $status = 'La publicación no se ha creado porque el formulario no es valido';
            }
            $this->session->getFlashBag()->add('status', $status);
            $this->session->getFlashBag()->add("message_class",$message_class);
            return $this->redirectToRoute('home_publications');
        }

        return $this->render('AppBundle:Publication:home.html.twig', array(
            'form' => $form->createView()
        ));
    }
}