<?php

namespace GarlicBlog\AppBundle\Controller;

use GarlicBlog\AppBundle\Entity\Article;
use GarlicBlog\AppBundle\Entity\Favorite;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $securityContext = $this->container->get('security.authorization_checker');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return redirectToRoute('homepage');
        }
         
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $params = array('userId' => $user->getId());
        $params['userName'] = $user->getUserName();
        
        $favoriteRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Favorite');
        $favorites = $favoriteRepo->getFavoriteByUserId($user->getId());
        if (!empty($favorites)) {
            $params['favorites'] = $favorites[0];
        }
        
        $sortBy = $request->request->get('sortBy');
        $articleRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Article');
        $params['articles'] = $articleRepo->orderByTime();
        
        $params['default_avatar'] = $this->getParameter('default_avatar');
        
        return $this->render('GarlicBlogAppBundle:Default:index.html.twig',$params);
    }
    
    /**
     * @Route("/articles/{id}", name="single_article")
     */
    public function singleArticleAction($id)
    {
        $articleRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Article');
        $articleRepo->addReadNum($id);
        $article = $articleRepo->findArticleById($id);
        
        if (empty($article)) {
            return $this->redirectToRoute('homepage');
        }
        $params = array('article' => $article[0]);
        
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
        
        return $this->render('GarlicBlogAppBundle:Articles:article.html.twig', $params);
    }
    
    /**
     * @Route("/editFavorite", name="add_to_favorite")
     */
    public function editFavoriteAction(Request $request)
    {
        $securityContext = $this->container->get('security.authorization_checker');
        $action = $request->request->get('action');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED') || empty($action)) {
            //if it's not logged in do nothing
            throw new \Exception("User not logged in yet.");
        }
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $userId = $user->getId();
        $userName = $user->getUserName();
        if ($userId != $request->request->get('userId')) {
            //if it's not the same user as logged in do nothing
            throw new \Exception("Not Allow to update other's favorite.");
        }
        
        switch ($action) {
            case 'add' :
            
                $article = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Article')->find($request->request->get('articleId'));

                $favorite = new Favorite();
                $favorite->setUserId($user);
                $favorite->setArticleid($article);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($favorite);
                $em->flush();
                break;
                
            case 'remove' :
                $favoriteRepo = $this->getDoctrine()->getRepository('GarlicBlogAppBundle:Favorite');
                $favoriteRepo->removeFormFavorite($request->request->get('articleId'),$request->request->get('userId'));
                break;
                
            default:
                break;
        }
        
        
        return new JsonResponse(array('result' => 'success'));
    }
}
