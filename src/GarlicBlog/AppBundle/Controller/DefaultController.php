<?php

namespace GarlicBlog\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $userName = $user->getUserName();
        
        $sortBy = $request->request->get('sortBy');
        $articleRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Article');
        $articles = $articleRepo->orderByTime();
        
        return $this->render(
            'GarlicBlogAppBundle:Default:index.html.twig',
            array(
                // last username entered by the user
                'userId'    => $userId,
                'userName'  => $userName,
                'articles' => $articles
            )
        );
    }
}
