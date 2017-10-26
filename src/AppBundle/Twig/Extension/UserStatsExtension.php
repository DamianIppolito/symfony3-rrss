<?php

namespace AppBundle\Twig\Extension;

use Symfony\Bridge\Doctrine\RegistryInterface;

class UserStatsExtension extends \Twig_Extension{

    protected $doctrine;

    public function __construct(RegistryInterface $doctrine){
        $this->doctrine = $doctrine;
    }

    public function getFilters(){
        return array(
            new \Twig_SimpleFilter('user_stats',array($this, 'userStatsFilter'))
        );
    }

    public function userStatsFilter($user){
        $like_repo = $this->doctrine->getRepository('BackendBundle:Like');
        $publications_repo = $this->doctrine->getRepository('BackendBundle:Publication');
        $following_repo = $this->doctrine->getRepository('BackendBundle:Following');

        $user_following = $following_repo->findBy(array('user' => $user));
        $user_followers = $following_repo->findBy(array('followed' => $user));
        $user_publications = $publications_repo->findBy(array('user' => $user));
        $user_likes = $like_repo->findBy(array('user' => $user));

        $result = array(
            'Siguiendo' => count($user_following),
            'Seguidores' => count($user_followers),
            'Publicaciones' => count($user_publications),
            'Likes' => count($user_likes)
        );

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user_stats';
    }
}
