<?php

namespace GarlicBlog\AppBundle\Controller;

use GarlicBlog\AppBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/addArticle", name="add_article")
     */
    public function addArticleAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $userName = $user->getUserName();
        
        $authorid = $request->request->get('authorid');
        $title = $request->request->get('title');
        $content = $request->request->get('content');
        $categoryId = $request->request->get('category');
        $privacy = $request->request->get('privacy');
        
        $article = new Article();
        $posttime = new \DateTime();
        $article->setPosttime($posttime);
        $article->setTitle($title);
        $article->setIntro(substr($content,0,100)."......");
        $article->setContent($content);
        //need to check if it's the author
        $article->setAuthorid($authorid);
        $article->setCategoryids($categoryId);
        $article->setPrivacy($privacy);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($article);
        $em->flush();
        
        $categoryRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Category');
        $categories = $categoryRepo->findAll();
        
        return $this->redirectToRoute('my_articles');
    }
    
    /**
     * @Route("/newArticle", name="new_article")
     */
    public function newArticleAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $userName = $user->getUserName();
        $categoryRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Category');
        $categories = $categoryRepo->findAll();
        return $this->render(
            'GarlicBlogAppBundle:Articles:newArticle.html.twig',
            array(
                // last username entered by the user
                'userId'    => $userId,
                'userName'  => $userName,
                'categories' => $categories
            )
        );
    }
    
    /**
     * @Route("/myArticles", name="my_articles")
     */
    public function myArticlesAction(Request $request)
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
                'articles' => $articles,
                'default_avatar' => $this->getParameter('default_avatar')            
            )
        );
    }
    
    /**
     * @Route("/articles/{id}", name="single_article")
     */
    public function singleArticleAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $userName = $user->getUserName();
        $articleRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Article');
        $article = $articleRepo->findArticleById($id);
        
        return $this->render(
                'GarlicBlogAppBundle:Articles:article.html.twig',
                array (
                    'userId'    => $userId,
                    'userName'  => $userName,
                    'article' => $article[0],
                    'default_avatar' => $this->getParameter('default_avatar')
                )
        );
    }
}
