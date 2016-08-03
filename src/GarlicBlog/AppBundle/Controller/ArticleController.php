<?php

namespace GarlicBlog\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ArticleController extends Controller
{
    
    /**
     * @Route("/newArticle", name="new_article")
     */
    public function newArticleAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $userName = $user->getUserName();
        return $this->render(
            'GarlicBlogAppBundle:Articles:newArticle.html.twig',
            array(
                // last username entered by the user
                'userId'    => $userId,
                'userName'  => $userName,
            )
        );
    }
    
    /**
     * @Route("/myArticles", name="my_articles")
     */
    public function myArticlesAction()
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
    
    /**
     * @Route("/articles/{id}", name="single_article")
     */
    public function singleArticleAction()
    {
        return $this->render('GarlicBlogAppBundle:Articles:article.html.twig');
    }
}
