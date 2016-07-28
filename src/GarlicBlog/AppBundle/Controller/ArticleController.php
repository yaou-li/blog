<?php

namespace GarlicBlog\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/articles/{id}", name="articles")
     */
    public function articleAction()
    {
        return $this->render('GarlicBlogAppBundle:Articles:article.html.twig');
    }
}
