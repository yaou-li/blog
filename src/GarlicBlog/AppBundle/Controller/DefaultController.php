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
        $sortBy = $request->request->get('sortBy');
        $articleRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Article');
        $articles = $articleRepo->orderByTime();
        $params = array('articles' => $articles);
        
        
        // if is already logged in
        $securityContext = $this->container->get('security.authorization_checker');
        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $params['userId'] = $user->getId();
            $params['userName'] = $user->getUserName();
            
            $favoriteRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Favorite');
            $favorites = $favoriteRepo->getFavoriteByUserId($user->getId());
            if (!empty($favorites)) {
                $params['favorites'] = $favorites[0];
            }
        }
        
        $params['default_avatar'] = $this->getParameter('default_avatar');
        
        return $this->render('GarlicBlogAppBundle:Default:index.html.twig', $params);
    }
}
