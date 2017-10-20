<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 20/10/2017
 * Time: 14:28
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class PublicationController
{
    public function indexAction(Request $request){
        echo "Acción index";
        die();
    }
}