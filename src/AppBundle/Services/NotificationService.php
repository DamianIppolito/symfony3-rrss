<?php
/**
 * Created by PhpStorm.
 * User: Damian
 * Date: 30/10/2017
 * Time: 18:04
 */

namespace AppBundle\Services;
use BackendBundle\Entity\Notification;

class NotificationService{
    public $manager;

    public function __construct($manager) {
        $this->manager = $manager;
    }

    public function set($user, $type, $type_id, $extra = null){
        $em = $this->manager;

        $notification = new Notification();
        $notification->setUser($user);
        $notification->setType($type);
        $notification->setTypeId($type_id);
        $notification->setReaded(0);
        $notification->setCreatedAt(new \DateTime('now'));
        $notification->setExtra($extra);

        $em->persist($notification);
        $flush = $em->flush();
        if($flush == null){
            $status = true;
        }else{
            $status = false;
        }

        return $status;
    }
}