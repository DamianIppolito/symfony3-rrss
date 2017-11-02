<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 02/11/2017
 * Time: 15:43
 */

namespace BackendBundle\Repository;


class UserRepository extends \Doctrine\ORM\EntityRepository {

    public function getFollowingUsers($user){
        $em = $this->getEntityManager();
        $following_repo = $em->getRepository('BackendBundle:Following');
        $following = $following_repo->findBy(array('user' => $user));
        $following_array = array();
    }
}