<?php

namespace GarlicBlog\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $userName = $user->getUserName();
        return $this->render(
            'GarlicBlogAppBundle:Default:index.html.twig',
            array(
                // last username entered by the user
                'userId'    => $userId,
                'userName'  => $userName,
            )
        );
    }
}
