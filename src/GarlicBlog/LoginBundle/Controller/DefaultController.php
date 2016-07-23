<?php

namespace GarlicBlog\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function indexAction(Request $request)
    {
		$authenticationUtils = $this->get('security.authentication_utils');

		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();

		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		return $this->render(
			'GarlicBlogLoginBundle:Default:index.html.twig',
			array(
				// last username entered by the user
				'last_username' => $lastUsername,
				'error'         => $error,
			)
		);
    }
}
